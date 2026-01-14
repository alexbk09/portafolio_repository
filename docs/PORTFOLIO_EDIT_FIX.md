# Solución del Error de Edición de Portafolio

## Problema
Al intentar editar un proyecto del portafolio en producción, se producía un error en la función JavaScript `editProject()` que impedía cargar los datos del proyecto en el modal de edición.

## Causa del Error
El error se debía a que la petición AJAX no incluía el token CSRF requerido por Laravel en producción, y no había un manejo adecuado de errores para diferentes códigos de estado HTTP.

## Solución Implementada

### 1. Mejora del JavaScript
- **Token CSRF**: Se agregó la obtención del token CSRF desde el meta tag
- **Headers apropiados**: Se incluyeron headers necesarios para la petición AJAX
- **Manejo de errores**: Se implementó un manejo específico para diferentes códigos de estado HTTP
- **Indicador de carga**: Se agregó un spinner durante la carga de datos
- **Refresco de token**: Se implementó la funcionalidad para refrescar el token CSRF cuando expira

### 2. Mejora del Controlador
- **Manejo de excepciones**: Se agregó un try-catch en el método `edit()` para manejar errores
- **Respuestas JSON**: Se mejoró la respuesta JSON para incluir información de error cuando sea necesario

### 3. Nueva Ruta
- **Refresco de token**: Se agregó la ruta `/csrf-token` para refrescar el token CSRF

## Código JavaScript Mejorado

```javascript
function editProject(projectId) {
    // Obtener el token CSRF del meta tag
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
    
    // Mostrar indicador de carga
    const button = event.target;
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;
    
    // Preparar headers
    const headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    };
    
    // Agregar token CSRF si está disponible
    if (token) {
        headers['X-CSRF-TOKEN'] = token;
    }
    
    // Cargar datos del proyecto
    fetch(`/admin/portfolio/${projectId}/edit`, {
        method: 'GET',
        headers: headers,
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('No tienes autorización para realizar esta acción. Por favor, inicia sesión nuevamente.');
            } else if (response.status === 403) {
                throw new Error('No tienes permisos para editar este proyecto.');
            } else if (response.status === 404) {
                throw new Error('El proyecto no fue encontrado.');
            } else if (response.status === 419) {
                // Token CSRF expirado, intentar refrescarlo
                return refreshCsrfToken().then(newToken => {
                    headers['X-CSRF-TOKEN'] = newToken;
                    return fetch(`/admin/portfolio/${projectId}/edit`, {
                        method: 'GET',
                        headers: headers,
                        credentials: 'same-origin'
                    });
                }).then(retryResponse => {
                    if (!retryResponse.ok) {
                        throw new Error('Error después de refrescar el token. Por favor, recarga la página.');
                    }
                    return retryResponse.json();
                });
            } else {
                throw new Error(`Error del servidor: ${response.status}`);
            }
        }
        return response.json();
    })
    .then(project => {
        // Verificar si la respuesta contiene un error
        if (project.error) {
            throw new Error(project.message || project.error);
        }
        
        // Llenar el formulario con los datos del proyecto
        // ... resto del código para llenar el formulario
    })
    .catch(error => {
        console.error('Error:', error);
        let errorMessage = 'Error al cargar los datos del proyecto.';
        
        if (error.name === 'TypeError' && error.message.includes('fetch')) {
            errorMessage = 'Error de conexión. Verifica tu conexión a internet e intenta nuevamente.';
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        alert(errorMessage);
    })
    .finally(() => {
        // Restaurar el botón
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}
```

## Códigos de Estado HTTP Manejados

- **401 Unauthorized**: Usuario no autenticado
- **403 Forbidden**: Usuario sin permisos
- **404 Not Found**: Proyecto no encontrado
- **419 Page Expired**: Token CSRF expirado
- **500 Internal Server Error**: Error del servidor

## Prevención de Problemas Similares

1. **Siempre incluir token CSRF** en peticiones AJAX
2. **Manejar códigos de estado HTTP** específicos
3. **Implementar indicadores de carga** para mejor UX
4. **Agregar manejo de errores** robusto
5. **Probar en entorno de producción** antes del despliegue

## Archivos Modificados

- `resources/views/admin/portfolio.blade.php`
- `app/Http/Controllers/PortfolioController.php`
- `routes/web.php`

## Pruebas Recomendadas

1. Probar edición de proyectos con sesión válida
2. Probar con token CSRF expirado
3. Probar con usuario sin permisos
4. Probar con conexión lenta o interrumpida
5. Probar en diferentes navegadores


