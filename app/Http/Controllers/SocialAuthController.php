<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirigir al usuario al proveedor OAuth
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtener información del usuario desde el proveedor OAuth
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Buscar si el usuario ya existe
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if (!$user) {
                // Crear nuevo usuario
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(16)), // Contraseña aleatoria
                    'role' => 'client', // Rol por defecto
                    'email_verified_at' => now(), // Email verificado por la red social
                    'social_id' => $socialUser->getId(),
                    'social_provider' => $provider,
                    'avatar' => $socialUser->getAvatar(),
                ]);
            } else {
                // Actualizar información social si es necesario
                $user->update([
                    'social_id' => $socialUser->getId(),
                    'social_provider' => $provider,
                    'avatar' => $socialUser->getAvatar(),
                ]);
            }
            
            // Iniciar sesión
            Auth::login($user);
            
            // Redirigir según el rol
            if ($user->isAdmin()) {
                return redirect()->route('dashboard')->with('success', '¡Bienvenido de vuelta!');
            } elseif ($user->isClient()) {
                return redirect()->route('client.dashboard')->with('success', '¡Bienvenido de vuelta!');
            } elseif ($user->isFreelancer()) {
                return redirect()->route('freelancer.dashboard')->with('success', '¡Bienvenido de vuelta!');
            } else {
                return redirect('/')->with('success', '¡Bienvenido!');
            }
            
        } catch (\Exception $e) {
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

