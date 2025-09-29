<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Google\Client;
use Google\Service\Drive;

class BackupToGoogleDrive extends Command
{
    protected $signature = 'backup:google-drive';
    protected $description = 'Backup database to Google Drive';

    public function handle()
    {
        $this->info('🚀 Iniciando backup de base de datos a Google Drive...');
        
        try {
            // 1. Crear backup local
            $this->info('📦 Creando backup local...');
            $exitCode = $this->call('backup:run', [
                '--only-db' => true,
                '--only-to-disk' => 'local'
            ]);

            if ($exitCode !== 0) {
                $this->error('❌ Error al crear backup local');
                return 1;
            }

            // 2. Encontrar el archivo de backup más reciente
            $this->info('🔍 Buscando archivo de backup...');
            $backupFiles = Storage::disk('local')->files('essalud-am-backup');

            // Si no encuentra en la carpeta esperada, buscar en la carpeta real
            if (empty($backupFiles)) {
                $backupFiles = Storage::disk('local')->files('essalud-am');
            }

            if (empty($backupFiles)) {
                $this->error('❌ No se encontraron archivos de backup');
                return 1;
            }

            // Obtener el archivo más reciente
            $latestBackup = collect($backupFiles)
                ->sortByDesc(function ($file) {
                    return Storage::disk('local')->lastModified($file);
                })
                ->first();

            $this->info("📁 Archivo de backup encontrado: {$latestBackup}");

            // 3. Subir a Google Drive el backup y el .env
            $this->info('☁️  Subiendo a Google Drive...');
            $successBackup = $this->uploadToGoogleDrive($latestBackup);

            // Subir el archivo .env
            $envPath = base_path('.env');
            if (file_exists($envPath)) {
                $this->info('☁️  Subiendo archivo .env a Google Drive...');
                $successEnv = $this->uploadToGoogleDrive($envPath, '.env');
            } else {
                $this->warn('⚠️  Archivo .env no encontrado, no se subirá a Google Drive.');
                $successEnv = true;
            }

            if ($successBackup && $successEnv) {
                $this->info('✅ Backup y .env subidos exitosamente a Google Drive');

                // 4. Limpiar archivo local
                $this->info('🧹 Limpiando archivo local...');
                Storage::disk('local')->delete($latestBackup);

                // 5. Limpiar backups antiguos en Google Drive
                $this->info('🗑️  Limpiando backups antiguos en Google Drive...');
                $this->cleanOldBackups();

                return 0;
            } else {
                $this->error('❌ Error al subir a Google Drive');
                return 1;
            }

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
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

            // Detectar mimeType
            $mimeType = 'application/zip';
            if ($fileName === '.env') {
                $mimeType = 'text/plain';
            }

            // Subir archivo
            $result = $service->files->create($fileMetadata, [
                'data' => $fileContent,
                'mimeType' => $mimeType,
                'uploadType' => 'multipart'
            ]);

            $this->info("📎 Archivo subido con ID: " . $result->getId() . " (" . $fileName . ")");

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

            // Obtener todos los archivos .zip y .env ordenados por fecha (más recientes primero)
            $files = $service->files->listFiles([
                'q' => "('$folderId' in parents) and (name contains '.zip' or name = '.env')",
                'fields' => 'files(id, name, createdTime)',
                'orderBy' => 'createdTime desc'
            ]);

            $allFiles = $files->getFiles();

            // Separar archivos .zip y .env
            $zipFiles = array_filter($allFiles, function($file) {
                return str_ends_with($file->getName(), '.zip');
            });
            $envFiles = array_filter($allFiles, function($file) {
                return $file->getName() === '.env';
            });

            $keepCount = 10;

            // Limpiar backups .zip
            if (count($zipFiles) > $keepCount) {
                $filesToDelete = array_slice(array_values($zipFiles), $keepCount);
                $this->info("📊 Encontrados ".count($zipFiles)." backups .zip, manteniendo $keepCount, eliminando " . count($filesToDelete));
                foreach ($filesToDelete as $file) {
                    try {
                        $service->files->delete($file->getId());
                        $this->info("🗑️  Eliminado: " . $file->getName());
                    } catch (\Exception $e) {
                        $this->warn("⚠️  No se pudo eliminar " . $file->getName() . ": " . $e->getMessage());
                    }
                }
            } else {
                $this->info("� Solo hay ".count($zipFiles)." backups .zip, no es necesario limpiar (máximo: $keepCount)");
            }

            // Limpiar backups .env
            if (count($envFiles) > $keepCount) {
                $filesToDelete = array_slice(array_values($envFiles), $keepCount);
                $this->info("📊 Encontrados ".count($envFiles)." archivos .env, manteniendo $keepCount, eliminando " . count($filesToDelete));
                foreach ($filesToDelete as $file) {
                    try {
                        $service->files->delete($file->getId());
                        $this->info("🗑️  Eliminado: " . $file->getName());
                    } catch (\Exception $e) {
                        $this->warn("⚠️  No se pudo eliminar " . $file->getName() . ": " . $e->getMessage());
                    }
                }
            } else {
                $this->info("� Solo hay ".count($envFiles)." archivos .env, no es necesario limpiar (máximo: $keepCount)");
            }

        } catch (\Exception $e) {
            $this->warn('⚠️  Error en limpieza automática: ' . $e->getMessage());
        }
    }
}