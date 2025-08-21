@php
    $captcha = \App\Helpers\CaptchaHelper::generateCaptcha();
    session([config('captcha.session_key', 'captcha_answer') => $captcha['answer']]);
@endphp
<div>
    <label for="captcha_answer" class="block text-sm font-medium text-gray-700 mb-2">
        {{ config('captcha.label', 'Verificación de Seguridad') }}
    </label>
    <div class="flex items-center space-x-4">
        <div class="flex-1">
            <p class="text-sm text-gray-600 mb-2">{{ $captcha['question'] }}</p>
            <input type="hidden" name="captcha_question" value="{{ $captcha['question'] }}">
            <input type="number" id="captcha_answer" name="captcha_answer" required 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('captcha') border-red-500 @enderror"
                   placeholder="{{ config('captcha.placeholder', 'Tu respuesta') }}">
        </div>
        <button type="button" onclick="refreshCaptcha()" class="px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors" title="{{ config('captcha.refresh_button_text', 'Refrescar') }}">
            <i class="fas fa-refresh"></i>
        </button>
    </div>
    @error('captcha')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
