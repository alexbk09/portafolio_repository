<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Mostrar la vista administrativa de skills
     */
    public function admin()
    {
        $skills = Skill::ordered()->get();
        return view('admin.skills', compact('skills'));
    }

    /**
     * Almacenar una nueva skill
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|in:frontend,backend,tools',
            'percentage' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'required|in:blue,green,red,yellow,purple,orange',
            'order' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $skill = Skill::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Habilidad creada exitosamente',
            'skill' => $skill
        ]);
    }

    /**
     * Actualizar una skill existente
     */
    public function update(Request $request, Skill $skill)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|in:frontend,backend,tools',
            'percentage' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'required|in:blue,green,red,yellow,purple,orange',
            'order' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $skill->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Habilidad actualizada exitosamente',
            'skill' => $skill
        ]);
    }

    /**
     * Eliminar una skill
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Habilidad eliminada exitosamente'
        ]);
    }

    /**
     * Obtener una skill para edición
     */
    public function edit(Skill $skill)
    {
        return response()->json($skill);
    }
}
