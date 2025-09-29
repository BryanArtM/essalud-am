<?php

require_once 'vendor/autoload.php';

use Google\Client;
use Google\Service\Drive;

echo "📂 Listando archivos en Google Drive...\n";
echo "=====================================\n";

// Cargar configuración desde .env
$envFile = file_get_contents('.env');
preg_match('/GOOGLE_DRIVE_CLIENT_ID=(.*)/', $envFile, $clientIdMatch);
preg_match('/GOOGLE_DRIVE_CLIENT_SECRET=(.*)/', $envFile, $clientSecretMatch);
preg_match('/GOOGLE_DRIVE_REFRESH_TOKEN=(.*)/', $envFile, $refreshTokenMatch);
preg_match('/GOOGLE_DRIVE_FOLDER_ID=(.*)/', $envFile, $folderIdMatch);

$clientId = trim($clientIdMatch[1] ?? '');
$clientSecret = trim($clientSecretMatch[1] ?? '');
$refreshToken = trim($refreshTokenMatch[1] ?? '');
$folderId = trim($folderIdMatch[1] ?? '');

try {
    $client = new Client();
    $client->setClientId($clientId);
    $client->setClientSecret($clientSecret);
    $client->refreshToken($refreshToken);
    
    $service = new Drive($client);
    
    // Listar archivos en la carpeta de backups
    echo "📁 Archivos en carpeta Laravel-Backups (ID: $folderId):\n\n";
    
    $files = $service->files->listFiles([
        'q' => "'$folderId' in parents",
        'fields' => 'files(id, name, size, createdTime, modifiedTime)',
        'orderBy' => 'createdTime desc'
    ]);
    
    $totalSize = 0;
    $count = 0;
    
    foreach ($files->getFiles() as $file) {
        $count++;
        $size = (int)$file->getSize();
        $totalSize += $size;
        
        echo "  {$count}. {$file->getName()}\n";
        echo "     📅 Creado: {$file->getCreatedTime()}\n";
        echo "     💾 Tamaño: " . formatBytes($size) . "\n";
        echo "     🆔 ID: {$file->getId()}\n\n";
    }
    
    echo "📊 RESUMEN:\n";
    echo "   📁 Total de archivos: $count\n";
    echo "   💾 Espacio total usado: " . formatBytes($totalSize) . "\n";
    echo "   🆓 Espacio libre en Google Drive: " . formatBytes(15 * 1024 * 1024 * 1024 - $totalSize) . "\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}