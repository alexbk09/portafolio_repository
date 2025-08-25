<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirigir al usuario al proveedor OAuth
     */
    public function redirect($provider)
    {
        try {
            Log::info("Iniciando redirección a {$provider}");
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            Log::error("Error en redirección a {$provider}: " . $e->getMessage());
            return redirect()->route('login')->with('error', 'Error al conectar con ' . ucfirst($provider));
        }
    }

    /**
     * Obtener información del usuario desde el proveedor OAuth
     */
    public function callback($provider)
    {
        try {
            Log::info("Callback recibido de {$provider}");
            
            $socialUser = Socialite::driver($provider)->user();
            Log::info("Usuario social obtenido: " . $socialUser->getEmail());
            
            // Obtener email o usar ID de GitHub como fallback
            $email = $socialUser->getEmail();
            $socialId = $socialUser->getId();
            
            if (!$email) {
                // Si no hay email, usar el ID de GitHub + @github.com
                $email = $socialId . '@github.com';
                Log::info("Email no disponible, usando fallback: " . $email);
            }
            
            // Buscar si el usuario ya existe por email o social_id
            $user = User::where('email', $email)
                       ->orWhere('social_id', $socialId)
                       ->first();
            
            if (!$user) {
                Log::info("Creando nuevo usuario para: " . $email);
                // Crear nuevo usuario
                $user = User::create([
                    'name' => $socialUser->getName() ?: 'Usuario',
                    'email' => $email,
                    'password' => Hash::make(Str::random(16)), // Contraseña aleatoria
                    'role' => 'client', // Rol por defecto
                    'email_verified_at' => now(), // Email verificado por la red social
                    'social_id' => $socialId,
                    'social_provider' => $provider,
                    'avatar' => $socialUser->getAvatar(),
                ]);
                Log::info("Usuario creado con ID: " . $user->id);
            } else {
                Log::info("Usuario existente encontrado: " . $user->id);
                // Actualizar información social si es necesario
                $user->update([
                    'social_id' => $socialId,
                    'social_provider' => $provider,
                    'avatar' => $socialUser->getAvatar(),
                    'email' => $email, // Actualizar email si cambió
                ]);
            }
            
            // Iniciar sesión
            Auth::login($user);
            Log::info("Usuario autenticado: " . $user->id);
            
            // Redirigir según el rol
            if ($user->isAdmin()) {
                Log::info("Redirigiendo admin a dashboard");
                return redirect()->route('dashboard')->with('success', '¡Bienvenido de vuelta!');
            } elseif ($user->isClient()) {
                Log::info("Redirigiendo cliente a client.dashboard");
                return redirect()->route('client.dashboard')->with('success', '¡Bienvenido de vuelta!');
            } elseif ($user->isFreelancer()) {
                Log::info("Redirigiendo freelancer a freelancer.dashboard");
                return redirect()->route('freelancer.dashboard')->with('success', '¡Bienvenido de vuelta!');
            } else {
                Log::info("Redirigiendo a home (sin rol específico)");
                return redirect('/')->with('success', '¡Bienvenido!');
            }
            
        } catch (\Exception $e) {
            Log::error("Error en callback de {$provider}: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
            return redirect()->route('login')->with('error', 'Error al autenticarse con ' . ucfirst($provider) . '. Por favor, intenta de nuevo.');
        }
    }

    /**
     * Mostrar formulario para seleccionar rol después del registro social
     */
    public function selectRole()
    {
        if (!session('social_user')) {
            return redirect()->route('login');
        }
        
        return view('auth.select-role');
    }

    /**
     * Guardar rol seleccionado
     */
    public function saveRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:client,freelancer'
        ]);

        $user = Auth::user();
        $user->update(['role' => $request->role]);

        // Redirigir según el rol
        if ($request->role === 'client') {
            return redirect()->route('client.dashboard')->with('success', '¡Perfil configurado exitosamente!');
        } else {
            return redirect()->route('freelancer.dashboard')->with('success', '¡Perfil configurado exitosamente!');
        }
    }
}

