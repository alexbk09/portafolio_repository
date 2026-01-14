#!/bin/bash

# Script para limpiar cache de Laravel en producción
# Uso: ./scripts/clear-cache.sh

echo "🧹 Limpiando cache de Laravel..."

# Limpiar cache de rutas
echo "📋 Limpiando cache de rutas..."
php artisan route:clear

# Limpiar cache de configuración
echo "⚙️  Limpiando cache de configuración..."
php artisan config:clear

# Limpiar cache de vistas
echo "👁️  Limpiando cache de vistas..."
php artisan view:clear

# Limpiar cache general
echo "🗂️  Limpiando cache general..."
php artisan cache:clear

# Limpiar cache de aplicación
echo "📱 Limpiando cache de aplicación..."
php artisan app:clear

# Regenerar cache optimizado
echo "🚀 Regenerando cache optimizado..."
php artisan optimize

# Verificar rutas
echo "🔍 Verificando rutas..."
php artisan route:list --name=admin.portfolio

echo "✅ Cache limpiado exitosamente!"
echo "🎯 Ahora puedes probar la edición de portafolio"


