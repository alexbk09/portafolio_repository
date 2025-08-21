# Portfolio Profesional - TuNombre

Un portfolio web profesional y moderno desarrollado con Laravel, diseñado para mostrar proyectos, habilidades y facilitar el contacto con clientes potenciales.

## 🚀 Características

- **Diseño Responsivo**: Se adapta perfectamente a todos los dispositivos
- **Sección Hero**: Presentación impactante con llamadas a la acción
- **Sobre Mí**: Información personal y estadísticas profesionales
- **Portfolio**: Galería de proyectos con filtros por tecnologías
- **Skills**: Visualización de habilidades técnicas con barras de progreso
- **Contacto**: Formulario de contacto funcional con validación
- **Sistema de Autenticación**: Login y registro de usuarios
- **Dashboard Administrativo**: Panel para gestionar contenido
- **Gestión de Proyectos**: CRUD completo para proyectos del portfolio
- **Gestión de Mensajes**: Sistema de mensajes de contacto
- **Diseño Moderno**: UI/UX profesional con Tailwind CSS

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 10
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Tailwind CSS
- **Base de Datos**: MySQL/PostgreSQL
- **Iconos**: Font Awesome
- **Fuentes**: Inter (Google Fonts)

## 📋 Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Servidor web (Apache/Nginx)

## 🔧 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/tuusuario/portfolio-programador.git
cd portfolio-programador
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar variables de entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos
Edita el archivo `.env` con tus credenciales de base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

### 6. Poblar la base de datos con datos de ejemplo
```bash
php artisan db:seed --class=PortfolioSeeder
```

### 7. Configurar almacenamiento
```bash
php artisan storage:link
```

### 8. Instalar dependencias de frontend (opcional)
```bash
npm install
npm run dev
```

### 9. Iniciar el servidor
```bash
php artisan serve
```

El sitio estará disponible en `http://localhost:8000`

## 👤 Configuración Inicial

### 1. Crear un usuario administrador
Regístrate en `/register` o crea un usuario directamente en la base de datos.

### 2. Personalizar información
Edita los siguientes archivos para personalizar tu información:

- `resources/views/welcome.blade.php` - Página principal
- `database/seeders/PortfolioSeeder.php` - Datos de ejemplo

### 3. Configurar datos personales
Actualiza en la página principal:
- Tu nombre
- Descripción profesional
- Información de contacto
- Enlaces a redes sociales

## 📁 Estructura del Proyecto

```
portfolio-programador/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── ContactController.php
│   │   └── PortfolioController.php
│   └── Models/
│       ├── Contact.php
│       ├── Project.php
│       └── Skill.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── auth/
│       ├── welcome.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## 🎨 Personalización

### Colores
Los colores principales se pueden modificar en:
- `resources/views/welcome.blade.php` (línea 15-25)
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/dashboard.blade.php`

### Contenido
- **Proyectos**: Gestiona desde el dashboard en `/admin/portfolio`
- **Mensajes**: Revisa mensajes de contacto en `/admin/contact`
- **Habilidades**: Modifica en `database/seeders/PortfolioSeeder.php`

### Imágenes
- Sube imágenes de proyectos a `storage/app/public/projects/`
- Las imágenes se sirven desde `public/storage/projects/`

## 🔐 Autenticación

El sistema incluye:
- Registro de usuarios
- Login con email y contraseña
- Protección de rutas administrativas
- Cerrar sesión

## 📧 Sistema de Contacto

- Formulario de contacto funcional
- Validación de datos
- Almacenamiento en base de datos
- Panel administrativo para gestionar mensajes
- Marcado de mensajes como leídos/no leídos

## 🚀 Despliegue

### Producción
1. Configurar variables de entorno para producción
2. Ejecutar `php artisan config:cache`
3. Ejecutar `php artisan route:cache`
4. Configurar servidor web (Apache/Nginx)
5. Configurar SSL/HTTPS

### Hosting Recomendado
- **VPS**: DigitalOcean, Linode, Vultr
- **Hosting Compartido**: Hostinger, Namecheap
- **PaaS**: Heroku, Railway, Vercel

## 📱 Responsive Design

El sitio está optimizado para:
- 📱 Móviles (320px+)
- 📱 Tablets (768px+)
- 💻 Desktop (1024px+)
- 🖥️ Pantallas grandes (1440px+)

## 🔧 Mantenimiento

### Actualizaciones
```bash
composer update
php artisan migrate
php artisan config:cache
```

### Backup
```bash
php artisan backup:run
```

### Logs
```bash
tail -f storage/logs/laravel.log
```

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 📞 Soporte

Si tienes alguna pregunta o necesitas ayuda:
- 📧 Email: tuemail@ejemplo.com
- 💬 Issues: [GitHub Issues](https://github.com/tuusuario/portfolio-programador/issues)

## 🙏 Agradecimientos

- [Laravel](https://laravel.com/) - Framework PHP
- [Tailwind CSS](https://tailwindcss.com/) - Framework CSS
- [Font Awesome](https://fontawesome.com/) - Iconos
- [Unsplash](https://unsplash.com/) - Imágenes de ejemplo

---

**Desarrollado con ❤️ por TuNombre**
