<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check storage configuration and permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Verificando configuración de Storage');
        $this->newLine();

        // Verificar configuración de storage
        $this->info('📋 Configuración de Storage:');
        $this->info('FILESYSTEM_DISK: ' . config('filesystems.default'));
        $this->info('APP_URL: ' . config('app.url'));
        $this->newLine();

        // Verificar directorio storage/app/public
        $storagePath = storage_path('app/public');
        $this->info('📁 Verificando directorio storage/app/public:');
        
        if (is_dir($storagePath)) {
            $this->info('✅ Directorio existe: ' . $storagePath);
            $this->info('📅 Permisos: ' . substr(sprintf('%o', fileperms($storagePath)), -4));
        } else {
            $this->error('❌ Directorio no existe: ' . $storagePath);
        }

        // Verificar directorio projects
        $projectsPath = storage_path('app/public/projects');
        $this->info('📁 Verificando directorio projects:');
        
        if (is_dir($projectsPath)) {
            $this->info('✅ Directorio existe: ' . $projectsPath);
            $this->info('📅 Permisos: ' . substr(sprintf('%o', fileperms($projectsPath)), -4));
            
            // Contar archivos
            $files = glob($projectsPath . '/*');
            $this->info('📊 Archivos en el directorio: ' . count($files));
        } else {
            $this->warn('⚠️  Directorio no existe: ' . $projectsPath);
            $this->info('💡 Creando directorio...');
            if (mkdir($projectsPath, 0755, true)) {
                $this->info('✅ Directorio creado exitosamente');
            } else {
                $this->error('❌ Error al crear directorio');
            }
        }

        $this->newLine();

        // Verificar enlace simbólico
        $this->info('🔗 Verificando enlace simbólico storage:');
        $publicStoragePath = public_path('storage');
        
        if (is_link($publicStoragePath)) {
            $this->info('✅ Enlace simbólico existe: ' . $publicStoragePath);
            $this->info('🔗 Apunta a: ' . readlink($publicStoragePath));
        } else {
            $this->warn('⚠️  Enlace simbólico no existe');
            $this->info('💡 Creando enlace simbólico...');
            
            try {
                $this->call('storage:link');
                $this->info('✅ Enlace simbólico creado exitosamente');
            } catch (\Exception $e) {
                $this->error('❌ Error al crear enlace simbólico: ' . $e->getMessage());
            }
        }

        $this->newLine();

        // Probar escritura
        $this->info('✍️  Probando escritura en storage:');
        try {
            $testFile = 'test-' . time() . '.txt';
            Storage::disk('public')->put($testFile, 'Test content');
            
            if (Storage::disk('public')->exists($testFile)) {
                $this->info('✅ Escritura exitosa');
                Storage::disk('public')->delete($testFile);
                $this->info('✅ Eliminación exitosa');
            } else {
                $this->error('❌ Error en escritura');
            }
        } catch (\Exception $e) {
            $this->error('❌ Error al probar escritura: ' . $e->getMessage());
        }

        $this->newLine();

        // Recomendaciones
        $this->info('💡 Recomendaciones:');
        $this->line('1. Si el enlace simbólico no existe: php artisan storage:link');
        $this->line('2. Si hay problemas de permisos: chmod -R 755 storage/');
        $this->line('3. Verificar que el directorio projects existe');
        $this->line('4. Revisar logs de Laravel para errores específicos');

        return 0;
    }
}


