# 🚀 Configuración de Laravel Socialite

Esta guía te ayudará a configurar Laravel Socialite para permitir el registro e inicio de sesión con redes sociales.

## 📋 Requisitos Previos

- Laravel Socialite instalado (`composer require laravel/socialite`)
- Cuentas de desarrollador en las redes sociales que quieras usar
- Dominio configurado (para producción)

## 🔧 Configuración de Variables de Entorno

Agrega estas variables a tu archivo `.env`:

```env
# Socialite Configuration
GOOGLE_CLIENT_ID=tu_google_client_id
GOOGLE_CLIENT_SECRET=tu_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

FACEBOOK_CLIENT_ID=tu_facebook_client_id
FACEBOOK_CLIENT_SECRET=tu_facebook_client_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback

GITHUB_CLIENT_ID=tu_github_client_id
GITHUB_CLIENT_SECRET=tu_github_client_secret
GITHUB_REDIRECT_URI=http://localhost:8000/auth/github/callback

LINKEDIN_CLIENT_ID=tu_linkedin_client_id
LINKEDIN_CLIENT_SECRET=tu_linkedin_client_secret
LINKEDIN_REDIRECT_URI=http://localhost:8000/auth/linkedin/callback
```

## 🔑 Configuración por Red Social

### Google OAuth 2.0

1. **Crear Proyecto en Google Cloud Console**
   - Ve a [Google Cloud Console](https://console.cloud.google.com/)
   - Crea un nuevo proyecto o selecciona uno existente
   - Habilita la API de Google+ (si no está habilitada)

2. **Configurar Credenciales OAuth 2.0**
   - Ve a "APIs & Services" → "Credentials"
   - Haz clic en "Create Credentials" → "OAuth 2.0 Client IDs"
   - Selecciona "Web application"
   - Agrega las URLs autorizadas:
     - **Authorized JavaScript origins:**
       - `http://localhost:8000` (desarrollo)
       - `https://tudominio.com` (producción)
     - **Authorized redirect URIs:**
       - `http://localhost:8000/auth/google/callback` (desarrollo)
       - `https://tudominio.com/auth/google/callback` (producción)

3. **Obtener Credenciales**
   - Copia el "Client ID" y "Client Secret"
   - Pégalos en tu archivo `.env`

### Facebook Login

1. **Crear Aplicación en Facebook Developers**
   - Ve a [Facebook Developers](https://developers.facebook.com/)
   - Haz clic en "Create App"
   - Selecciona "Consumer" o "Business"
   - Completa la información básica

2. **Configurar Facebook Login**
   - En el dashboard de tu app, agrega "Facebook Login"
   - Ve a "Settings" → "Basic"
   - Agrega las URLs de redirección:
     - `http://localhost:8000/auth/facebook/callback` (desarrollo)
     - `https://tudominio.com/auth/facebook/callback` (producción)

3. **Obtener Credenciales**
   - Copia el "App ID" y "App Secret"
   - Pégalos en tu archivo `.env`

### GitHub OAuth App

1. **Crear OAuth App en GitHub**
   - Ve a [GitHub Settings](https://github.com/settings/developers)
   - Haz clic en "New OAuth App"
   - Completa la información:
     - **Application name:** Tu nombre de aplicación
     - **Homepage URL:** `http://localhost:8000` (desarrollo)
     - **Authorization callback URL:** `http://localhost:8000/auth/github/callback`

2. **Obtener Credenciales**
   - Copia el "Client ID" y "Client Secret"
   - Pégalos en tu archivo `.env`

### LinkedIn OAuth 2.0

1. **Crear Aplicación en LinkedIn**
   - Ve a [LinkedIn Developers](https://www.linkedin.com/developers/)
   - Haz clic en "Create App"
   - Completa la información de la aplicación

2. **Configurar OAuth 2.0**
   - Ve a "Auth" → "OAuth 2.0 settings"
   - Agrega las URLs de redirección:
     - `http://localhost:8000/auth/linkedin/callback` (desarrollo)
     - `https://tudominio.com/auth/linkedin/callback` (producción)

3. **Obtener Credenciales**
   - Copia el "Client ID" y "Client Secret"
   - Pégalos en tu archivo `.env`

## 🚀 Configuración para Producción

### Actualizar URLs de Redirección

Cuando despliegues en producción, actualiza las URLs de redirección en:

1. **Tu archivo `.env`:**
   ```env
   GOOGLE_REDIRECT_URI=https://tudominio.com/auth/google/callback
   FACEBOOK_REDIRECT_URI=https://tudominio.com/auth/facebook/callback
   GITHUB_REDIRECT_URI=https://tudominio.com/auth/github/callback
   LINKEDIN_REDIRECT_URI=https://tudominio.com/auth/linkedin/callback
   ```

2. **Las plataformas de desarrollador:**
   - Google Cloud Console
   - Facebook Developers
   - GitHub Settings
   - LinkedIn Developers

### Configurar HTTPS

Asegúrate de que tu sitio use HTTPS en producción, ya que muchas redes sociales requieren conexiones seguras.

## 🧪 Pruebas

### Probar la Configuración

1. **Verificar Variables de Entorno**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Probar Rutas**
   - Visita `/auth/google/redirect` para probar Google
   - Visita `/auth/facebook/redirect` para probar Facebook
   - Visita `/auth/github/redirect` para probar GitHub
   - Visita `/auth/linkedin/redirect` para probar LinkedIn

3. **Verificar Callbacks**
   - Asegúrate de que las URLs de callback estén correctamente configuradas
   - Verifica que los permisos de la aplicación incluyan los scopes necesarios

## 🔒 Seguridad

### Mejores Prácticas

1. **Nunca compartas credenciales**
   - Mantén las credenciales seguras
   - No las subas a repositorios públicos

2. **Usar Variables de Entorno**
   - Siempre usa variables de entorno para credenciales
   - Nunca hardcodees credenciales en el código

3. **Validar Datos**
   - Valida siempre los datos que recibes de las redes sociales
   - Implementa validaciones adicionales si es necesario

4. **Manejar Errores**
   - Implementa manejo de errores robusto
   - Proporciona mensajes de error útiles al usuario

## 🐛 Solución de Problemas

### Errores Comunes

1. **"Invalid redirect URI"**
   - Verifica que las URLs de redirección coincidan exactamente
   - Asegúrate de que no haya espacios extra

2. **"Client ID not found"**
   - Verifica que las credenciales estén correctamente configuradas
   - Limpia la caché de configuración

3. **"Scope not allowed"**
   - Verifica que tu aplicación tenga los permisos necesarios
   - Revisa la configuración de scopes en la plataforma de desarrollador

### Logs de Depuración

Habilita el logging para depurar problemas:

```php
// En config/logging.php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single', 'daily'],
        'ignore_exceptions' => false,
    ],
],
```

## 📚 Recursos Adicionales

- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [Facebook Login Documentation](https://developers.facebook.com/docs/facebook-login/)
- [GitHub OAuth Documentation](https://docs.github.com/en/developers/apps/building-oauth-apps)
- [LinkedIn OAuth Documentation](https://docs.microsoft.com/en-us/linkedin/shared/authentication/authentication)

## ✅ Checklist de Configuración

- [ ] Laravel Socialite instalado
- [ ] Variables de entorno configuradas
- [ ] Credenciales de Google configuradas
- [ ] Credenciales de Facebook configuradas
- [ ] Credenciales de GitHub configuradas
- [ ] Credenciales de LinkedIn configuradas
- [ ] URLs de redirección configuradas
- [ ] Pruebas realizadas en desarrollo
- [ ] Configuración de producción actualizada
- [ ] HTTPS configurado (producción)
- [ ] Manejo de errores implementado
- [ ] Logs de depuración configurados

¡Con esta configuración, tu aplicación estará lista para ofrecer autenticación social! 🎉






