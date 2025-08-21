<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaptchaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('captcha.enabled', true)) {
            return $next($request);
        }

        if ($request->isMethod('POST')) {
            $captchaAnswer = $request->input('captcha_answer');
            $captchaQuestion = $request->input('captcha_question');
            $expectedAnswer = $request->session()->get(config('captcha.session_key', 'captcha_answer'));

            if (!$captchaAnswer || !$captchaQuestion || !$expectedAnswer || $captchaAnswer != $expectedAnswer) {
                return back()->withErrors(['captcha' => config('captcha.error_message', 'La respuesta del captcha es incorrecta.')])->withInput();
            }

            // Limpiar el captcha de la sesión después de validarlo
            $request->session()->forget(config('captcha.session_key', 'captcha_answer'));
        }

        return $next($request);
    }
}
