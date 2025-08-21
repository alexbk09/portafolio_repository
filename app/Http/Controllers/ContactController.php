<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'captcha_answer' => 'required|numeric',
            'captcha_question' => 'required|string',
        ]);

        // Validar captcha
        $captchaAnswer = $request->input('captcha_answer');
        $expectedAnswer = $request->session()->get(config('captcha.session_key', 'captcha_answer'));

        if (!$expectedAnswer || $captchaAnswer != $expectedAnswer) {
            return back()->withErrors(['captcha' => config('captcha.error_message', 'La respuesta del captcha es incorrecta.')])->withInput();
        }

        // Limpiar el captcha de la sesión
        $request->session()->forget(config('captcha.session_key', 'captcha_answer'));

        // Remover campos del captcha antes de crear el contacto
        unset($validated['captcha_answer'], $validated['captcha_question']);
        
        $contact = Contact::create($validated);

        // Aquí puedes agregar el envío de email de notificación
        // Mail::to('tuemail@ejemplo.com')->send(new ContactMessage($contact));

        return redirect()->back()->with('success', 'Mensaje enviado exitosamente. Te responderemos pronto.');
    }

    public function admin()
    {
        $messages = Contact::latest()->paginate(15);
        
        return view('admin.contact', compact('messages'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contact.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contact')->with('success', 'Mensaje eliminado exitosamente');
    }

    public function markAsRead(Contact $contact)
    {
        $contact->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'Mensaje marcado como leído');
    }
}
