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
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        Project::create($validated);

        return redirect()->route('admin.portfolio')->with('success', 'Proyecto creado exitosamente');
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
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $validated['image'] = $imagePath;
        }

        $project->update($validated);

        return redirect()->route('admin.portfolio')->with('success', 'Proyecto actualizado exitosamente');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.portfolio')->with('success', 'Proyecto eliminado exitosamente');
    }
}
