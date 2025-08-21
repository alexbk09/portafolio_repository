# Componentes de Navegación

Este proyecto incluye componentes reutilizables para la navegación que mejoran la mantenibilidad y consistencia del código.

## Componentes Disponibles

### 1. Navegación Pública (`x-navigation.public-nav`)
Componente para la navegación principal del sitio público.

**Características:**
- Navegación fija con efecto de blur
- Enlaces a todas las secciones principales
- Botones de autenticación dinámicos
- Diseño responsive

**Uso:**
```blade
<x-navigation.public-nav />
```

### 2. Navegación Administrativa (`x-navigation.admin-nav`)
Componente para el panel administrativo con sidebar.

**Características:**
- Header con información del usuario
- Sidebar con navegación administrativa
- Indicador de página activa
- Área de contenido principal

**Uso:**
```blade
<x-navigation.admin-nav>
    <!-- Contenido de la página -->
    <h2>Título de la página</h2>
    <div>Contenido...</div>
</x-navigation.admin-nav>
```

### 3. Navegación Simple (`x-navigation.simple-nav`)
Componente para páginas con navegación simplificada.

**Características:**
- Navegación fija
- Enlaces básicos
- Botón de login

**Uso:**
```blade
<x-navigation.simple-nav />
```

### 4. Footer (`x-footer`)
Componente de pie de página reutilizable.

**Características:**
- Información de contacto
- Enlaces a redes sociales
- Enlaces de navegación
- Copyright

**Uso:**
```blade
<x-footer />
```

## Layouts

### Layout Administrativo (`layouts.admin`)
Layout específico para páginas administrativas.

**Características:**
- Incluye automáticamente la navegación administrativa
- Configuración de Tailwind CSS
- Fuentes y estilos consistentes

**Uso:**
```blade
@extends('layouts.admin')

@section('title', 'Título de la Página')

@section('content')
    <!-- Contenido de la página -->
@endsection
```

## Archivos de Componentes

### Navegación
- `resources/views/components/navigation/public-nav.blade.php`
- `resources/views/components/navigation/admin-nav.blade.php`
- `resources/views/components/navigation/simple-nav.blade.php`

### Footer
- `resources/views/components/footer.blade.php`

### Layouts
- `resources/views/layouts/admin.blade.php`

## Implementación en Vistas

### Página Principal (welcome.blade.php)
```blade
<body>
    <x-navigation.public-nav />
    <!-- Contenido de la página -->
    <x-footer />
</body>
```

### Portfolio (portfolio/index.blade.php)
```blade
<body>
    <x-navigation.simple-nav />
    <!-- Contenido de la página -->
    <x-footer />
</body>
```

### Dashboard Administrativo
```blade
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Contenido de la página -->
@endsection
```

## Personalización

### Cambiar Colores
Los colores se definen en la configuración de Tailwind CSS en cada layout:

```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#2563eb',
                secondary: '#1e40af',
                accent: '#3b82f6',
                dark: '#1f2937',
                light: '#f8fafc'
            }
        }
    }
}
```

### Agregar Nuevos Enlaces
Para agregar nuevos enlaces a la navegación, edita el componente correspondiente:

1. **Navegación Pública**: Edita `public-nav.blade.php`
2. **Navegación Administrativa**: Edita `admin-nav.blade.php`
3. **Navegación Simple**: Edita `simple-nav.blade.php`

### Modificar el Footer
Edita `footer.blade.php` para cambiar:
- Información de contacto
- Enlaces a redes sociales
- Enlaces de navegación
- Texto del copyright

## Ventajas de la Componentización

1. **Mantenibilidad**: Cambios centralizados en un solo lugar
2. **Consistencia**: Diseño uniforme en todas las páginas
3. **Reutilización**: Componentes que se pueden usar en múltiples vistas
4. **Escalabilidad**: Fácil agregar nuevas páginas con navegación consistente
5. **DRY**: No repetir código de navegación

## Migración de Vistas Existentes

Para migrar una vista existente a usar componentes:

1. **Reemplazar navegación manual**:
   ```blade
   <!-- Antes -->
   <nav class="...">
       <!-- Código de navegación -->
   </nav>
   
   <!-- Después -->
   <x-navigation.public-nav />
   ```

2. **Usar layout administrativo**:
   ```blade
   <!-- Antes -->
   @extends('layouts.app')
   
   <!-- Después -->
   @extends('layouts.admin')
   ```

3. **Agregar footer**:
   ```blade
   <!-- Antes -->
   <footer class="...">
       <!-- Código del footer -->
   </footer>
   
   <!-- Después -->
   <x-footer />
   ```

## Troubleshooting

### El componente no se renderiza
- Verificar que el archivo del componente existe
- Comprobar la sintaxis del nombre del componente
- Ejecutar `php artisan view:clear`

### Estilos no se aplican
- Verificar que Tailwind CSS esté incluido
- Comprobar que las clases CSS estén correctas
- Revisar la configuración de colores

### Navegación no funciona
- Verificar que las rutas estén definidas
- Comprobar que los enlaces tengan las URLs correctas
- Revisar que el middleware de autenticación esté configurado

