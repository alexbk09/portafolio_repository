# Solución de Problemas de Storage y Checkbox

## Problemas Identificados

1. **Imágenes no se guardan** al crear o editar proyectos
2. **Checkbox de destacado no funciona** correctamente

## Causas de los Problemas

### Imágenes
- Enlace simbólico de storage no existe o está roto
- Directorio `projects` no existe en `storage/app/public/`
- Problemas de permisos en el directorio storage
- Falta de validación de archivos en el frontend

### Checkbox
- No se maneja correctamente el valor del checkbox en el controlador
- Falta el atributo `value="1"` en el input
- No se valida correctamente si el checkbox está marcado

## Soluciones Implementadas

### 1. Controlador Mejorado

#### Método `store()` y `update()`
```php
// Manejar el checkbox featured correctamente
$validated['featured'] = $request->has('featured');

// Manejar la imagen con mejor manejo de errores
if ($request->hasFile('image')) {
    try {
        $imagePath = $request->file('image')->store('projects', 'public');
        $validated['image'] = $imagePath;
        \Log::info('Imagen guardada: ' . $imagePath);
    } catch (\Exception $e) {
        \Log::error('Error al guardar imagen: ' . $e->getMessage());
        return redirect()->route('admin.portfolio')->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
    }
}
```

### 2. JavaScript Mejorado

#### Validación de Archivos
```javascript
// Validación de archivos
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validar tamaño (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('La imagen no puede ser mayor a 2MB');
            this.value = '';
            return;
        }
        
        // Validar tipo
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Solo se permiten archivos de imagen (JPEG, PNG, JPG, GIF)');
            this.value = '';
            return;
        }
    }
});
```

#### Validación del Formulario
```javascript
// Validación del formulario antes de enviar
document.getElementById('projectForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const technologies = document.getElementById('technologies').value.trim();
    
    if (!title || !description || !technologies) {
        e.preventDefault();
        alert('Por favor, completa todos los campos requeridos');
        return;
    }
    
    console.log('Formulario enviado con featured:', document.getElementById('featured').checked);
});
```

### 3. HTML Mejorado

#### Checkbox con valor
```html
<input type="checkbox" id="featured" name="featured" value="1" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
```

### 4. Comandos de Diagnóstico

#### Verificar Storage
```bash
php artisan check:storage
```

#### Arreglar Storage
```bash
./scripts/fix-storage.sh
```

## Comandos para Solucionar en Producción

### Opción 1: Script Automático
```bash
chmod +x scripts/fix-storage.sh
./scripts/fix-storage.sh
```

### Opción 2: Comandos Manuales
```bash
# 1. Crear enlace simbólico
php artisan storage:link

# 2. Crear directorio projects
mkdir -p storage/app/public/projects

# 3. Ajustar permisos
chmod -R 755 storage/
chmod -R 755 public/storage/

# 4. Verificar configuración
php artisan check:storage

# 5. Limpiar cache
php artisan cache:clear
php artisan config:clear
```

## Verificación

### 1. Verificar Enlace Simbólico
```bash
ls -la public/storage
```
Debería mostrar un enlace simbólico que apunte a `../storage/app/public`

### 2. Verificar Directorio Projects
```bash
ls -la storage/app/public/projects
```
Debería existir y tener permisos de escritura

### 3. Probar Subida de Imagen
1. Ir al panel de administración
2. Crear un nuevo proyecto
3. Seleccionar una imagen
4. Verificar que se guarde correctamente

### 4. Probar Checkbox
1. Marcar/desmarcar el checkbox de destacado
2. Guardar el proyecto
3. Verificar que el estado se mantenga

## Logs y Debugging

### Verificar Logs de Laravel
```bash
tail -f storage/logs/laravel.log
```

### Logs Específicos
- `Imagen guardada: projects/filename.jpg`
- `Proyecto creado exitosamente`
- `Error al guardar imagen: [mensaje]`

## Prevención

1. **Siempre ejecutar** `php artisan storage:link` después del despliegue
2. **Verificar permisos** del directorio storage
3. **Probar subida de archivos** en el entorno de staging
4. **Monitorear logs** para errores de storage
5. **Usar comando de diagnóstico** regularmente

## Archivos Modificados

1. **app/Http/Controllers/PortfolioController.php**: Mejorado manejo de imágenes y checkbox
2. **resources/views/admin/portfolio.blade.php**: Agregada validación y mejor manejo del checkbox
3. **app/Console/Commands/CheckStorage.php**: Comando de diagnóstico (NUEVO)
4. **scripts/fix-storage.sh**: Script de reparación (NUEVO)

## Solución Rápida

Si necesitas una solución inmediata:

1. **Subir los archivos modificados**
2. **Ejecutar**: `php artisan storage:link`
3. **Ejecutar**: `mkdir -p storage/app/public/projects`
4. **Ejecutar**: `chmod -R 755 storage/`
5. **Probar** subida de imágenes y checkbox

El sistema ahora maneja correctamente las imágenes y el checkbox de destacado.


