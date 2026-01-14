<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class DiagnoseRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diagnose:routes {--name= : Filter routes by name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose route problems in production';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Diagnóstico de Rutas en Producción');
        $this->newLine();

        // Verificar rutas de portfolio
        $this->info('📋 Verificando rutas de portfolio...');
        $portfolioRoutes = Route::getRoutes()->filter(function ($route) {
            return str_contains($route->uri(), 'portfolio');
        });

        if ($portfolioRoutes->count() > 0) {
            $this->table(
                ['Método', 'URI', 'Nombre', 'Middleware'],
                $portfolioRoutes->map(function ($route) {
                    return [
                        implode('|', $route->methods()),
                        $route->uri(),
                        $route->getName() ?? 'Sin nombre',
                        implode(', ', $route->middleware())
                    ];
                })->toArray()
            );
        } else {
            $this->error('❌ No se encontraron rutas de portfolio');
        }

        $this->newLine();

        // Verificar middleware registrados
        $this->info('🔧 Verificando middleware registrados...');
        $middleware = app('router')->getMiddleware();
        $roleMiddleware = collect($middleware)->filter(function ($class, $alias) {
            return str_contains($alias, 'role') || str_contains($class, 'Role');
        });

        if ($roleMiddleware->count() > 0) {
            $this->table(
                ['Alias', 'Clase'],
                $roleMiddleware->map(function ($class, $alias) {
                    return [$alias, $class];
                })->toArray()
            );
        } else {
            $this->warn('⚠️  No se encontraron middleware de roles');
        }

        $this->newLine();

        // Verificar cache de rutas
        $this->info('🗂️  Verificando cache de rutas...');
        $routeCachePath = storage_path('framework/cache/routes.php');
        
        if (file_exists($routeCachePath)) {
            $this->info('✅ Cache de rutas existe');
            $this->info('📅 Última modificación: ' . date('Y-m-d H:i:s', filemtime($routeCachePath)));
        } else {
            $this->warn('⚠️  Cache de rutas no existe');
        }

        $this->newLine();

        // Verificar configuración de producción
        $this->info('⚙️  Verificando configuración...');
        $this->info('APP_ENV: ' . config('app.env'));
        $this->info('APP_DEBUG: ' . (config('app.debug') ? 'true' : 'false'));
        $this->info('APP_URL: ' . config('app.url'));

        $this->newLine();

        // Recomendaciones
        $this->info('💡 Recomendaciones:');
        $this->line('1. Ejecutar: php artisan route:clear');
        $this->line('2. Ejecutar: php artisan optimize:clear');
        $this->line('3. Ejecutar: php artisan optimize');
        $this->line('4. Verificar permisos de archivos');
        $this->line('5. Revisar logs de Laravel en storage/logs/');

        return 0;
    }
}


