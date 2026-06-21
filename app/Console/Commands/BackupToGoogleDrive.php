<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Google\Client;
use Google\Service\Drive;

class BackupToGoogleDrive extends Command
{
    protected $signature = 'backup:google-drive';
    protected $description = 'Backup database to Google Drive';

    public function handle()
    {
        $this->info('Iniciando backup de base de datos a Google Drive...');
        
        try {
            // 1. Crear backup local
            $this->info('Creando backup local...');
            $exitCode = $this->call('backup:run', [
                '--only-db' => true,
                '--only-to-disk' => 'local'
            ]);

            if ($exitCode !== 0) {
                $this->error('Error al crear backup local');
                $this->sendFailureNotification('Error al crear backup local de la base de datos');
                return 1;
            }

            // 2. Encontrar el archivo de backup más reciente
            $this->info('Buscando archivo de backup...');
            $backupFiles = Storage::disk('local')->files('essalud-am-backup');

            // Si no encuentra en la carpeta esperada, buscar en la carpeta real
            if (empty($backupFiles)) {
                $backupFiles = Storage::disk('local')->files('essalud-am');
            }

            if (empty($backupFiles)) {
                $this->error('No se encontraron archivos de backup');
                $this->sendFailureNotification('No se encontraron archivos de backup para subir a Google Drive');
                return 1;
            }

            // Obtener el archivo más reciente
            $latestBackup = collect($backupFiles)
                ->sortByDesc(function ($file) {
                    return Storage::disk('local')->lastModified($file);
                })
                ->first();

            $this->info("Archivo de backup encontrado: {$latestBackup}");

            // 3. Subir a Google Drive el backup
            $this->info('Subiendo a Google Drive...');
            $successBackup = $this->uploadToGoogleDrive($latestBackup);

            if ($successBackup) {
                $this->info('Backup subido exitosamente a Google Drive');

                // 4. Limpiar archivo local
                $this->info('Limpiando archivo local...');
                Storage::disk('local')->delete($latestBackup);

                // 5. Limpiar backups antiguos en Google Drive
                $this->info('Limpiando backups antiguos en Google Drive...');
                $this->cleanOldBackups();

                return 0;
            } else {
                $this->error('Error al subir a Google Drive');
                $this->sendFailureNotification('Error al subir archivos de backup a Google Drive. Revisar credenciales y configuración.');
                return 1;
            }

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->sendFailureNotification('Error general en backup: ' . $e->getMessage());
            return 1;
        }
    }
    
    private function uploadToGoogleDrive($localFilePath, $customName = null)
    {
        try {
            // Configurar cliente de Google
            $client = new Client();
            $client->setClientId(config('google_drive.client_id'));
            $client->setClientSecret(config('google_drive.client_secret'));
            $client->refreshToken(config('google_drive.refresh_token'));

            $service = new Drive($client);

            // Leer archivo local
            if (is_file($localFilePath)) {
                $fileContent = file_get_contents($localFilePath);
            } else {
                $fileContent = Storage::disk('local')->get($localFilePath);
            }
            $fileName = $customName ?? basename($localFilePath);

            // Configurar metadata del archivo
            $fileMetadata = new Drive\DriveFile([
                'name' => $fileName,
                'parents' => [config('google_drive.folder_id')]
            ]);

            // Subir archivo
            $result = $service->files->create($fileMetadata, [
                'data' => $fileContent,
                'mimeType' => 'application/zip',
                'uploadType' => 'multipart'
            ]);

            $this->info("Archivo subido con ID: " . $result->getId() . " (" . $fileName . ")");

            return true;

        } catch (\Exception $e) {
            $this->error('Error al subir archivo: ' . $e->getMessage());
            return false;
        }
    }
    
    private function cleanOldBackups()
    {
        try {
            // Configurar cliente de Google
            $client = new Client();
            $client->setClientId(config('google_drive.client_id'));
            $client->setClientSecret(config('google_drive.client_secret'));
            $client->refreshToken(config('google_drive.refresh_token'));

            $service = new Drive($client);
            $folderId = config('google_drive.folder_id');

            // Obtener todos los archivos .zip ordenados por fecha (más recientes primero)
            $files = $service->files->listFiles([
                'q' => "('$folderId' in parents) and (name contains '.zip')",
                'fields' => 'files(id, name, createdTime)',
                'orderBy' => 'createdTime desc'
            ]);

            $zipFiles = $files->getFiles();
            $keepCount = 20;

            // Limpiar backups .zip
            if (count($zipFiles) > $keepCount) {
                $filesToDelete = array_slice($zipFiles, $keepCount);
                $this->info("Encontrados ".count($zipFiles)." backups .zip, manteniendo $keepCount, eliminando " . count($filesToDelete));
                foreach ($filesToDelete as $file) {
                    try {
                        $service->files->delete($file->getId());
                        $this->info("Eliminado: " . $file->getName());
                    } catch (\Exception $e) {
                        $this->warn("No se pudo eliminar " . $file->getName() . ": " . $e->getMessage());
                    }
                }
            } else {
                $this->info("Solo hay ".count($zipFiles)." backups .zip, no es necesario limpiar (máximo: $keepCount)");
            }

        } catch (\Exception $e) {
            $this->warn('Error en limpieza automática: ' . $e->getMessage());
        }
    }

    private function sendFailureNotification($message)
    {
        try {
            $to = env('BACKUP_ALERT_EMAIL', 'barteagame@gmail.com');
            $subject = 'ALERTA: Fallo en Backup Automático - EsSalud AM';
            
            $emailBody = "
            <h2 style='color: #dc2626;'>Error en Backup Automático</h2>
            <p><strong>Aplicación:</strong> Programa del Adulto Mayor - EsSalud</p>
            <p><strong>Fecha/Hora:</strong> " . now()->format('d/m/Y H:i:s') . "</p>
            <p><strong>Servidor:</strong> " . gethostname() . "</p>
            <p><strong>Error:</strong> {$message}</p>
            
            <h3>Acciones recomendadas:</h3>
            <ul>
                <li>Verificar conectividad con Google Drive</li>
                <li>Revisar credenciales de Google OAuth</li>
                <li>Comprobar logs en: storage/logs/backup.log</li>
                <li>Ejecutar manualmente: php artisan backup:google-drive</li>
            </ul>
            
            <p><em>Este es un mensaje automático del sistema de backup.</em></p>
            ";

            Mail::html($emailBody, function ($mail) use ($to, $subject) {
                $mail->to($to)
                     ->subject($subject)
                     ->from(env('MAIL_FROM_ADDRESS', 'noreply.essalud.am@gmail.com'), 'Sistema Backup EsSalud-AM');
            });

            $this->info('Notificación de error enviada a: ' . $to);
            
        } catch (\Exception $e) {
            $this->warn('No se pudo enviar notificación por email: ' . $e->getMessage());
        }
    }
}