<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $query = Testimonial::approved();
        
        // Aplicar filtros
        if (request('filter') === 'featured') {
            $query->featured();
        } elseif (request('filter') === 'recent') {
            $query->latest();
        }
        
        $testimonials = $query->paginate(12);
        
        // Calcular estadísticas
        $totalTestimonials = Testimonial::approved()->count();
        $averageRating = Testimonial::approved()->avg('rating') ?? 0;
        $featuredCount = Testimonial::approved()->featured()->count();
        
        return view('testimonials.index', compact('testimonials', 'totalTestimonials', 'averageRating', 'featuredCount'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'testimonial' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial = Testimonial::create($validated);

        // Crear notificación para el admin
        Notification::create([
            'type' => 'testimonial',
            'title' => 'Nuevo Testimonio',
            'message' => "Nuevo testimonio de {$testimonial->name} esperando aprobación",
            'icon' => 'fas fa-star',
            'color' => 'yellow',
            'data' => ['testimonial_id' => $testimonial->id]
        ]);

        return redirect()->back()->with('success', 'Testimonio enviado exitosamente. Será revisado antes de ser publicado.');
    }

    public function admin()
    {
        $query = Testimonial::with('user');
        
        // Aplicar filtros
        if (request('filter') === 'pending') {
            $query->where('approved', false);
        } elseif (request('filter') === 'approved') {
            $query->where('approved', true);
        } elseif (request('filter') === 'featured') {
            $query->where('featured', true);
        }
        
        $testimonials = $query->latest()->paginate(15);
        
        // Calcular estadísticas
        $totalTestimonials = Testimonial::count();
        $pendingTestimonials = Testimonial::where('approved', false)->count();
        $approvedTestimonials = Testimonial::where('approved', true)->count();
        $featuredTestimonials = Testimonial::where('featured', true)->count();
        
        return view('admin.testimonials', compact('testimonials', 'totalTestimonials', 'pendingTestimonials', 'approvedTestimonials', 'featuredTestimonials'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['approved' => true]);

        // Notificar al usuario
        Notification::create([
            'user_id' => $testimonial->user_id,
            'type' => 'testimonial_approved',
            'title' => 'Testimonio Aprobado',
            'message' => 'Tu testimonio ha sido aprobado y publicado',
            'icon' => 'fas fa-check-circle',
            'color' => 'green'
        ]);

        return redirect()->back()->with('success', 'Testimonio aprobado exitosamente');
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->delete();

        // Notificar al usuario
        Notification::create([
            'user_id' => $testimonial->user_id,
            'type' => 'testimonial_rejected',
            'title' => 'Testimonio Rechazado',
            'message' => 'Tu testimonio ha sido rechazado',
            'icon' => 'fas fa-times-circle',
            'color' => 'red'
        ]);

        return redirect()->back()->with('success', 'Testimonio rechazado exitosamente');
    }

    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update(['featured' => !$testimonial->featured]);
        return redirect()->back()->with('success', 'Estado destacado actualizado');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimonio eliminado exitosamente');
    }
}
