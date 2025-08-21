<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Notification;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = auth()->user()->quotes()->latest()->paginate(10);
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'project_type' => 'required|string|in:web,mobile,design,consulting,other',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'deadline' => 'nullable|date|after:today'
        ]);

        $validated['user_id'] = auth()->id();
        $quote = Quote::create($validated);

        // Crear notificación para el admin
        Notification::create([
            'type' => 'quote',
            'title' => 'Nueva Cotización',
            'message' => "Nueva cotización de {$quote->project_name} por " . auth()->user()->name,
            'icon' => 'fas fa-file-invoice-dollar',
            'color' => 'blue',
            'data' => ['quote_id' => $quote->id]
        ]);

        return redirect()->route('quotes.index')->with('success', 'Cotización enviada exitosamente. Te contactaremos pronto.');
    }

    public function show(Quote $quote)
    {
        // Verificar que el usuario autenticado sea el propietario de la cotización
        if (auth()->id() !== $quote->user_id) {
            abort(403);
        }
        return view('quotes.show', compact('quote'));
    }

    public function admin()
    {
        $query = Quote::with('user');
        
        // Aplicar filtros
        if (request('filter') === 'pending') {
            $query->where('status', 'pending');
        } elseif (request('filter') === 'reviewed') {
            $query->where('status', 'reviewed');
        } elseif (request('filter') === 'approved') {
            $query->where('status', 'approved');
        } elseif (request('filter') === 'rejected') {
            $query->where('status', 'rejected');
        }
        
        $quotes = $query->latest()->paginate(15);
        
        // Calcular estadísticas
        $totalQuotes = Quote::count();
        $pendingQuotes = Quote::where('status', 'pending')->count();
        $approvedQuotes = Quote::where('status', 'approved')->count();
        $rejectedQuotes = Quote::where('status', 'rejected')->count();
        
        return view('admin.quotes', compact('quotes', 'totalQuotes', 'pendingQuotes', 'approvedQuotes', 'rejectedQuotes'));
    }

    public function updateStatus(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $quote->update($validated);

        // Notificar al usuario
        $statusMessages = [
            'reviewed' => 'Tu cotización está siendo revisada',
            'approved' => 'Tu cotización ha sido aprobada',
            'rejected' => 'Tu cotización ha sido rechazada'
        ];

        if (isset($statusMessages[$validated['status']])) {
            Notification::create([
                'user_id' => $quote->user_id,
                'type' => 'quote_status',
                'title' => 'Estado de Cotización Actualizado',
                'message' => $statusMessages[$validated['status']],
                'icon' => 'fas fa-file-invoice-dollar',
                'color' => $validated['status'] === 'approved' ? 'green' : ($validated['status'] === 'rejected' ? 'red' : 'blue')
            ]);
        }

        return redirect()->back()->with('success', 'Estado de cotización actualizado');
    }

    public function destroy(Quote $quote)
    {
        // Verificar que el usuario autenticado sea el propietario de la cotización
        if (auth()->id() !== $quote->user_id) {
            abort(403);
        }
        $quote->delete();
        return redirect()->route('quotes.index')->with('success', 'Cotización eliminada exitosamente');
    }

    public function adminDestroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->back()->with('success', 'Cotización eliminada exitosamente');
    }
}
