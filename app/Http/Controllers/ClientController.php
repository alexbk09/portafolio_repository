<?php

namespace App\Http\Controllers;

use App\Models\ClientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $profile = $user->clientProfile;
        $quotes = $user->quotes()->latest()->take(5)->get();
        $testimonials = $user->testimonials()->latest()->take(5)->get();
        $unreadNotifications = $user->unreadNotifications()->take(5)->get();

        return view('client.dashboard', compact('profile', 'quotes', 'testimonials', 'unreadNotifications'));
    }

    public function profile()
    {
        $profile = auth()->user()->clientProfile;
        return view('client.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $profile = auth()->user()->clientProfile;

        if ($request->hasFile('avatar')) {
            // Eliminar avatar anterior si existe
            if ($profile && $profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('client-avatars', 'public');
        }

        if ($profile) {
            $profile->update($validated);
        } else {
            $validated['user_id'] = auth()->id();
            ClientProfile::create($validated);
        }

        return redirect()->back()->with('success', 'Perfil actualizado exitosamente');
    }

    public function quotes()
    {
        $quotes = auth()->user()->quotes()->latest()->paginate(10);
        return view('client.quotes', compact('quotes'));
    }

    public function testimonials()
    {
        $testimonials = auth()->user()->testimonials()->latest()->paginate(10);
        return view('client.testimonials', compact('testimonials'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        return view('client.notifications', compact('notifications'));
    }

    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    }

    public function markAllNotificationsAsRead()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        return redirect()->back()->with('success', 'Todas las notificaciones marcadas como leídas');
    }
}
