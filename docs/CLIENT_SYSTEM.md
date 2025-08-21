# Sistema de Clientes - Portfolio Programador

## Descripción General

Se ha implementado un sistema completo de gestión de clientes que incluye:

- **Dashboard de Clientes**: Panel de control personalizado para usuarios con rol 'client'
- **Gestión de Perfiles**: Formulario para que los clientes completen su información personal y empresarial
- **Sistema de Cotizaciones**: Formulario para solicitar cotizaciones de proyectos
- **Sistema de Testimonios**: Formulario para que los clientes dejen testimonios
- **Sistema de Notificaciones**: Notificaciones en tiempo real para mantener informados a los clientes
- **Panel Administrativo**: Gestión completa desde el panel de administración

## Características Implementadas

### 1. Dashboard de Clientes (`/client/dashboard`)
- Estadísticas en tiempo real (cotizaciones, testimonios, notificaciones)
- Acciones rápidas para navegar a las diferentes secciones
- Notificaciones recientes
- Cotizaciones recientes

### 2. Gestión de Perfiles (`/client/profile`)
- Formulario para completar información personal
- Información de empresa (nombre, industria, tamaño)
- Subida de avatar
- Información de contacto

### 3. Sistema de Cotizaciones
- **Lista de Cotizaciones** (`/client/quotes`): Ver todas las cotizaciones del cliente
- **Crear Cotización** (`/quotes/create`): Formulario para solicitar nueva cotización
- **Ver Cotización** (`/quotes/{id}`): Detalles completos de una cotización específica

### 4. Sistema de Testimonios
- **Lista de Testimonios** (`/client/testimonials`): Ver testimonios del cliente
- **Crear Testimonio** (`/testimonials/create`): Formulario para dejar nuevo testimonio
- **Vista Pública** (`/testimonials`): Página pública con todos los testimonios aprobados

### 5. Sistema de Notificaciones
- **Lista de Notificaciones** (`/client/notifications`): Ver todas las notificaciones
- Marcado como leído/no leído
- Diferentes tipos de notificaciones (cotizaciones, testimonios, etc.)

## Panel Administrativo

### Gestión de Testimonios (`/admin/testimonials`)
- Aprobar/rechazar testimonios
- Marcar como destacados
- Estadísticas de testimonios
- Filtros por estado

### Gestión de Cotizaciones (`/admin/quotes`)
- Aprobar/rechazar cotizaciones
- Agregar notas del administrador
- Estadísticas de cotizaciones
- Filtros por estado

### Gestión de Notificaciones (`/admin/notifications`)
- Ver todas las notificaciones del sistema
- Marcar como leídas
- Estadísticas de notificaciones
- Filtros por tipo y estado

## Base de Datos

### Tablas Creadas

1. **testimonials**
   - `id`, `user_id`, `name`, `position`, `company`
   - `testimonial`, `rating`, `image`
   - `approved`, `featured`, `created_at`, `updated_at`

2. **quotes**
   - `id`, `user_id`, `project_name`, `description`
   - `project_type`, `budget_min`, `budget_max`, `deadline`
   - `status`, `admin_notes`, `created_at`, `updated_at`

3. **notifications**
   - `id`, `user_id`, `type`, `title`, `message`
   - `icon`, `color`, `data`, `read_at`
   - `created_at`, `updated_at`

## Modelos

### Testimonial
- Relación con User
- Accessors para `image_url` y `stars`
- Scopes para `approved()` y `featured()`

### Quote
- Relación con User
- Accessors para `budget_range`, `status_color`, `status_text`
- Casts para fechas y JSON

### Notification
- Relación con User
- Métodos `isRead()`, `markAsRead()`
- Scopes para `unread()`, `read()`, `forUser()`, `forAdmin()`

## Controladores

### ClientController
- Dashboard del cliente
- Gestión de perfil
- Lista de cotizaciones, testimonios y notificaciones

### TestimonialController
- Vista pública de testimonios
- Creación y gestión de testimonios
- Panel administrativo

### QuoteController
- Creación y gestión de cotizaciones
- Panel administrativo
- Actualización de estados

### NotificationController
- Gestión de notificaciones
- Marcado como leído
- Panel administrativo

## Rutas

### Rutas Públicas
- `GET /testimonials` - Vista pública de testimonios

### Rutas de Cliente (requieren autenticación y rol 'client')
- `GET /client/dashboard` - Dashboard del cliente
- `GET /client/profile` - Perfil del cliente
- `PUT /client/profile` - Actualizar perfil
- `GET /client/quotes` - Cotizaciones del cliente
- `GET /client/testimonials` - Testimonios del cliente
- `GET /client/notifications` - Notificaciones del cliente

### Rutas de Cotizaciones
- `GET /quotes/create` - Crear cotización
- `POST /quotes` - Guardar cotización
- `GET /quotes/{id}` - Ver cotización
- `DELETE /quotes/{id}` - Eliminar cotización

### Rutas de Testimonios
- `GET /testimonials/create` - Crear testimonio
- `POST /testimonials` - Guardar testimonio
- `DELETE /testimonials/{id}` - Eliminar testimonio

### Rutas Administrativas (requieren rol 'admin')
- `GET /admin/testimonials` - Gestión de testimonios
- `POST /admin/testimonials/{id}/approve` - Aprobar testimonio
- `POST /admin/testimonials/{id}/reject` - Rechazar testimonio
- `POST /admin/testimonials/{id}/toggle-featured` - Marcar como destacado
- `GET /admin/quotes` - Gestión de cotizaciones
- `PUT /admin/quotes/{id}/status` - Actualizar estado de cotización
- `GET /admin/notifications` - Gestión de notificaciones

## Vistas

### Vistas de Cliente
- `resources/views/client/dashboard.blade.php`
- `resources/views/client/profile.blade.php`
- `resources/views/client/quotes.blade.php`
- `resources/views/client/testimonials.blade.php`
- `resources/views/client/notifications.blade.php`

### Vistas de Cotizaciones
- `resources/views/quotes/create.blade.php`
- `resources/views/quotes/show.blade.php`

### Vistas de Testimonios
- `resources/views/testimonials/create.blade.php`
- `resources/views/testimonials/index.blade.php`

### Vistas Administrativas
- `resources/views/admin/testimonials.blade.php`
- `resources/views/admin/quotes.blade.php`
- `resources/views/admin/notifications.blade.php`

## Características de Seguridad

- **Middleware de Roles**: Control de acceso basado en roles
- **Validación de Formularios**: Validación completa en el servidor
- **Autorización**: Verificación de permisos en controladores
- **Sanitización de Datos**: Limpieza de datos de entrada

## Datos de Prueba

Se incluye un seeder (`TestDataSeeder`) con:
- Usuario cliente de prueba
- Testimonios de ejemplo
- Cotizaciones de ejemplo
- Notificaciones de ejemplo

### Credenciales de Prueba
- **Email**: cliente@ejemplo.com
- **Password**: password
- **Rol**: client

## Funcionalidades Futuras Sugeridas

1. **Sistema de Chat**: Comunicación en tiempo real entre cliente y administrador
2. **Sistema de Archivos**: Subida de documentos y archivos del proyecto
3. **Sistema de Pagos**: Integración con pasarelas de pago
4. **Sistema de Calendario**: Programación de reuniones y entregas
5. **Sistema de Reportes**: Generación de reportes y estadísticas
6. **API REST**: Endpoints para integración con aplicaciones móviles

## Notas de Implementación

- Todas las vistas utilizan Tailwind CSS para el diseño
- Se mantiene consistencia con el diseño existente del portfolio
- Implementación responsive para dispositivos móviles
- Uso de componentes Blade para reutilización de código
- Sistema de notificaciones en tiempo real
- Validación tanto en frontend como backend

