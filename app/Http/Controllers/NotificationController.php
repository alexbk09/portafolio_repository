<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);
        return redirect()->back()->with('success', 'Todas las notificaciones marcadas como leídas');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
        return redirect()->back()->with('success', 'Notificación eliminada');
    }

    public function clearAll()
    {
        auth()->user()->notifications()->delete();
        return redirect()->back()->with('success', 'Todas las notificaciones eliminadas');
    }

    // Métodos para el admin
    public function admin()
    {
        $query = Notification::with('user');
        
        // Aplicar filtros
        if (request('filter') === 'unread') {
            $query->unread();
        } elseif (request('filter') === 'read') {
            $query->read();
        }
        
        $notifications = $query->latest()->paginate(20);
        
        // Calcular estadísticas
        $totalNotifications = Notification::count();
        $unreadNotifications = Notification::unread()->count();
        $readNotifications = Notification::read()->count();
        $usersWithNotifications = Notification::distinct('user_id')->count();
        
        return view('admin.notifications', compact('notifications', 'totalNotifications', 'unreadNotifications', 'readNotifications', 'usersWithNotifications'));
    }

    public function adminDestroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return redirect()->back()->with('success', 'Notificación eliminada');
    }

    public function adminMarkAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notificación marcada como leída');
    }

    public function adminMarkAllAsRead()
    {
        Notification::unread()->update(['read_at' => now()]);
        return redirect()->back()->with('success', 'Todas las notificaciones marcadas como leídas');
    }

    public function adminClearAll()
    {
        Notification::truncate();
        return redirect()->back()->with('success', 'Todas las notificaciones eliminadas');
    }
}
