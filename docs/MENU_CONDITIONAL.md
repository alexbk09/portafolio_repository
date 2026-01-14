# Sistema de Menús Condicionales por Rol

## Descripción

Se ha implementado un sistema completo de menús condicionales que se adaptan automáticamente según el rol del usuario autenticado. Cada rol (Administrador, Cliente, Freelancer) ve únicamente las opciones de menú que le corresponden.

## Características Implementadas

### 1. Menú Dinámico Principal (`admin-nav.blade.php`)
- **Detección Automática de Rol**: Usa `Auth::user()->isAdmin()`, `isClient()`, `isFreelancer()`
- **Indicador Visual de Rol**: Badge con color distintivo en la barra superior
- **Menús Específicos**: Cada rol ve solo sus opciones relevantes

### 2. Componentes de Navegación Específicos

#### Navegación de Administradores
- **Color**: Rojo (`bg-red-100 text-red-800`)
- **Opciones**:
  - Dashboard
  - Portfolio
  - Mensajes
  - Habilidades
  - Freelancers
  - Testimonios
  - Cotizaciones
  - Notificaciones

#### Navegación de Clientes
- **Color**: Azul (`bg-blue-100 text-blue-800`)
- **Opciones**:
  - Mi Dashboard
  - Mi Perfil
  - Mis Cotizaciones
  - Nueva Cotización
  - Mis Testimonios
  - Nuevo Testimonio
  - Mis Notificaciones (con contador de no leídas)

#### Navegación de Freelancers
- **Color**: Verde (`bg-green-100 text-green-800`)
- **Opciones**:
  - Mi Dashboard
  - Mi Perfil
  - Editar Perfil

### 3. Layouts Específicos por Rol

#### Layout de Administradores (`layouts.admin.blade.php`)
- Usa `<x-navigation.admin-nav />`
- Colores primarios azules
- Acceso completo a todas las funcionalidades

#### Layout de Clientes (`layouts.client.blade.php`)
- Usa `<x-navigation.client-nav />`
- Colores primarios azules
- Funcionalidades específicas de clientes

#### Layout de Freelancers (`layouts.freelancer.blade.php`)
- Usa `<x-navigation.freelancer-nav />`
- Colores primarios verdes
- Funcionalidades específicas de freelancers

## Implementación Técnica

### 1. Detección de Roles
```php
// En el modelo User
public function isAdmin() { return $this->role === 'admin'; }
public function isClient() { return $this->role === 'client'; }
public function isFreelancer() { return $this->role === 'freelancer'; }
```

### 2. Condiciones en Blade
```blade
@if(Auth::user()->isAdmin())
    <!-- Menú de administrador -->
@elseif(Auth::user()->isClient())
    <!-- Menú de cliente -->
@elseif(Auth::user()->isFreelancer())
    <!-- Menú de freelancer -->
@endif
```

### 3. Indicadores Visuales
```blade
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
    {{ Auth::user()->isAdmin() ? 'bg-red-100 text-red-800' : 
       (Auth::user()->isClient() ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
    {{ Auth::user()->isAdmin() ? 'Administrador' : 
       (Auth::user()->isClient() ? 'Cliente' : 'Freelancer') }}
</span>
```

## Características Especiales

### 1. Contador de Notificaciones
- Los clientes ven un badge rojo con el número de notificaciones no leídas
- Se actualiza automáticamente

### 2. Estados Activos
- El menú actual se resalta con fondo azul
- Usa `request()->routeIs()` para detectar la página actual

### 3. Enlaces Comunes
- Todos los roles tienen acceso a "Ver Sitio Web"
- Separado visualmente con una línea divisoria

## Estructura de Archivos

### Componentes de Navegación
- `resources/views/components/navigation/admin-nav.blade.php` - Menú principal dinámico
- `resources/views/components/navigation/client-nav.blade.php` - Menú específico de clientes
- `resources/views/components/navigation/freelancer-nav.blade.php` - Menú específico de freelancers

### Layouts
- `resources/views/layouts/admin.blade.php` - Layout para administradores
- `resources/views/layouts/client.blade.php` - Layout para clientes
- `resources/views/layouts/freelancer.blade.php` - Layout para freelancers

### Vistas Actualizadas
- `resources/views/client/dashboard.blade.php` - Usa layout de cliente
- `resources/views/client/profile.blade.php` - Usa layout de cliente
- `resources/views/client/quotes.blade.php` - Usa layout de cliente
- `resources/views/client/testimonials.blade.php` - Usa layout de cliente
- `resources/views/client/notifications.blade.php` - Usa layout de cliente

## Beneficios

### 1. Experiencia de Usuario
- **Navegación Intuitiva**: Cada usuario ve solo lo que necesita
- **Reducción de Confusión**: No hay opciones irrelevantes
- **Acceso Rápido**: Menús optimizados por rol

### 2. Seguridad
- **Control de Acceso**: Los menús reflejan los permisos reales
- **Prevención de Errores**: No se pueden acceder rutas no autorizadas desde el menú

### 3. Mantenibilidad
- **Código Organizado**: Cada rol tiene su propio componente
- **Fácil Extensión**: Agregar nuevos roles es sencillo
- **Reutilización**: Componentes modulares

## Personalización de Colores

### Administradores
- **Primario**: `#3B82F6` (Azul)
- **Secundario**: `#1E40AF` (Azul oscuro)
- **Badge**: Rojo

### Clientes
- **Primario**: `#3B82F6` (Azul)
- **Secundario**: `#1E40AF` (Azul oscuro)
- **Badge**: Azul

### Freelancers
- **Primario**: `#10B981` (Verde)
- **Secundario**: `#059669` (Verde oscuro)
- **Badge**: Verde

## Funcionalidades Futuras

1. **Menús Desplegables**: Submenús para organizar mejor las opciones
2. **Personalización**: Permitir que los usuarios personalicen su menú
3. **Notificaciones en Tiempo Real**: Actualización automática de contadores
4. **Modo Oscuro**: Tema oscuro para cada rol
5. **Responsive Avanzado**: Menús adaptativos para móviles

## Notas de Implementación

- Todos los menús son completamente responsivos
- Se mantiene consistencia visual en toda la aplicación
- Los colores se definen mediante variables CSS
- La detección de roles es eficiente y segura
- Los layouts son reutilizables y modulares






