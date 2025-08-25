# Sistema de Captcha

Este proyecto incluye un sistema de captcha matemático personalizado para mejorar la seguridad en los formularios de contacto, login y registro.

## Características

- **Captcha matemático**: Genera operaciones matemáticas simples (suma, resta, multiplicación)
- **Configurable**: Fácil de configurar y personalizar
- **Reutilizable**: Componente Blade que se puede usar en cualquier formulario
- **Responsive**: Diseño adaptativo que funciona en dispositivos móviles
- **Accesible**: Incluye etiquetas y mensajes de error claros

## Archivos del Sistema

### Core Files
- `app/Helpers/CaptchaHelper.php` - Generador de captchas matemáticos
- `app/Http/Middleware/CaptchaMiddleware.php` - Middleware para validación
- `config/captcha.php` - Configuración del sistema
- `resources/views/components/captcha.blade.php` - Componente Blade reutilizable

### Implementación
- `resources/views/welcome.blade.php` - Formulario de contacto
- `resources/views/auth/login.blade.php` - Formulario de login
- `resources/views/auth/register.blade.php` - Formulario de registro
- `app/Http/Controllers/ContactController.php` - Validación en contacto
- `app/Http/Controllers/AuthController.php` - Validación en autenticación

## Configuración

### Habilitar/Deshabilitar
```php
// En config/captcha.php o .env
'CAPTCHA_ENABLED' => true/false
```

### Personalizar Operaciones
```php
// En config/captcha.php
'operations' => [
    'add' => [
        'symbol' => '+',
        'min' => 1,
        'max' => 20,
    ],
    'subtract' => [
        'symbol' => '-',
        'min' => 10,
        'max' => 30,
    ],
    'multiply' => [
        'symbol' => '×',
        'min' => 2,
        'max' => 12,
    ],
],
```

### Personalizar Textos
```php
// En config/captcha.php
'label' => 'Verificación de Seguridad',
'placeholder' => 'Tu respuesta',
'error_message' => 'La respuesta del captcha es incorrecta.',
'refresh_button_text' => 'Refrescar',
```

## Uso

### En Formularios
```blade
<form method="POST" action="{{ route('contact.store') }}">
    @csrf
    <!-- Otros campos del formulario -->
    
    <x-captcha />
    
    <button type="submit">Enviar</button>
</form>
```

### JavaScript para Refrescar
```javascript
function refreshCaptcha() {
    fetch('/refresh-captcha')
        .then(response => response.json())
        .then(data => {
            document.querySelector('p[class*="text-sm text-gray-600 mb-2"]').textContent = data.question;
            document.querySelector('input[name="captcha_question"]').value = data.question;
            document.querySelector('input[name="captcha_answer"]').value = '';
        })
        .catch(error => {
            console.error('Error refreshing captcha:', error);
        });
}
```

## Rutas

- `GET /refresh-captcha` - Genera un nuevo captcha y retorna JSON

## Seguridad

- El captcha se almacena en la sesión del usuario
- Se valida en el servidor antes de procesar el formulario
- Se limpia de la sesión después de la validación
- Previene ataques automatizados y spam

## Personalización

### Agregar Nuevas Operaciones
1. Agregar la operación en `config/captcha.php`
2. Implementar la lógica en `CaptchaHelper::generateCaptcha()`

### Cambiar el Diseño
1. Modificar `resources/views/components/captcha.blade.php`
2. Actualizar los estilos CSS según sea necesario

### Integrar con Otros Formularios
1. Agregar `<x-captcha />` al formulario
2. Incluir la validación en el controlador correspondiente
3. Agregar el middleware si es necesario

## Troubleshooting

### El captcha no se valida
- Verificar que la sesión esté funcionando correctamente
- Revisar que el middleware esté registrado en `bootstrap/app.php`
- Comprobar que la configuración esté cargada

### El captcha no se refresca
- Verificar que la ruta `/refresh-captcha` esté definida
- Comprobar que el JavaScript esté incluido en la página
- Revisar la consola del navegador para errores

### Errores de configuración
- Ejecutar `php artisan config:clear` para limpiar la caché
- Verificar que el archivo `config/captcha.php` esté presente
- Comprobar que los valores de configuración sean válidos




