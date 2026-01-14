<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        $skills = Skill::all();
        
        return view('portfolio.index', compact('projects', 'skills'));
    }

    public function show(Project $project)
    {
        return view('portfolio.show', compact('project'));
    }

    public function admin()
    {
        $projects = Project::latest()->paginate(10);
        $skills = Skill::all();
        
        return view('admin.portfolio', compact('projects', 'skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'featured' => 'boolean',
        ]);

        // Manejar el checkbox featured correctamente
        $validated['featured'] = $request->has('featured');

        // Manejar la imagen
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('projects', 'public');
                $validated['image'] = $imagePath;
                \Log::info('Imagen guardada: ' . $imagePath);
            } catch (\Exception $e) {
                \Log::error('Error al guardar imagen: ' . $e->getMessage());
                return redirect()->route('admin.portfolio')->with('error', 'Error al guardar la imagen: ' . $e->getMessage());
            }
        }

        try {
            Project::create($validated);
            \Log::info('Proyecto creado exitosamente', $validated);
            return redirect()->route('admin.portfolio')->with('success', 'Proyecto creado exitosamente');
        } catch (\Exception $e) {
            \Log::error('Error al crear proyecto: ' . $e->getMessage());
            return redirect()->route('admin.portfolio')->with('error', 'Error al crear el proyecto: ' . $e->getMessage());
        }
    }

    public function edit(Project $project)
    {
        try {
            return response()->json($project);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar el proyecto',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function editById($id)
    {
        try {
            $project = Project::findOrFail($id);
            return response()->json($project);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Proyecto no encontrado',
                'message' => 'El proyecto con ID ' . $id . ' no existe'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar el proyecto',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'featured' => 'boolean',
        ]);

        // Manejar el checkbox featured correctamente
        $validated['featured'] = $request->has('featured');

        // Manejar la imagen
        if ($request->hasFile('image')) {
            try {
                // Eliminar imagen anterior si existe
                if ($project->image) {
                    \Storage::disk('public')->delete($project->image);
                    \Log::info('Imagen anterior eliminada: ' . $project->image);
                }
                
                $imagePath = $request->file('image')->store('projects', 'public');
                $validated['image'] = $imagePath;
                \Log::info('Nueva imagen guardada: ' . $imagePath);
            } catch (\Exception $e) {
                \Log::error('Error al actualizar imagen: ' . $e->getMessage());
                return redirect()->route('admin.portfolio')->with('error', 'Error al actualizar la imagen: ' . $e->getMessage());
            }
        }

        try {
            $project->update($validated);
            \Log::info('Proyecto actualizado exitosamente', $validated);
            return redirect()->route('admin.portfolio')->with('success', 'Proyecto actualizado exitosamente');
        } catch (\Exception $e) {
            \Log::error('Error al actualizar proyecto: ' . $e->getMessage());
            return redirect()->route('admin.portfolio')->with('error', 'Error al actualizar el proyecto: ' . $e->getMessage());
        }
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.portfolio')->with('success', 'Proyecto eliminado exitosamente');
    }
}
