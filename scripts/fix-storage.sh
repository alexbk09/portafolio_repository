#!/bin/bash

# Script para arreglar problemas de storage en producción
# Uso: ./scripts/fix-storage.sh

echo "🔧 Arreglando problemas de Storage en Producción..."
echo ""

# 1. Crear enlace simbólico si no existe
echo "🔗 Verificando enlace simbólico..."
if [ ! -L "public/storage" ]; then
    echo "📋 Creando enlace simbólico..."
    php artisan storage:link
    echo "✅ Enlace simbólico creado"
else
    echo "✅ Enlace simbólico ya existe"
fi

echo ""

# 2. Crear directorio projects si no existe
echo "📁 Verificando directorio projects..."
if [ ! -d "storage/app/public/projects" ]; then
    echo "📋 Creando directorio projects..."
    mkdir -p storage/app/public/projects
    echo "✅ Directorio projects creado"
else
    echo "✅ Directorio projects ya existe"
fi

echo ""

# 3. Ajustar permisos
echo "🔐 Ajustando permisos..."
chmod -R 755 storage/
chmod -R 755 public/storage/
echo "✅ Permisos ajustados"

echo ""

# 4. Verificar configuración
echo "🔍 Verificando configuración..."
php artisan check:storage

echo ""

# 5. Limpiar cache
echo "🗂️  Limpiando cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo ""

echo "✅ Proceso completado!"
echo "🎯 Ahora puedes probar subir imágenes y usar el checkbox de destacado"


