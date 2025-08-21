<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FreelancerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FreelancerController extends Controller
{
    /**
     * Mostrar lista de freelancers (público)
     */
    public function index()
    {
        $freelancers = User::where('role', 'freelancer')
            ->with('freelancerProfile')
            ->whereHas('freelancerProfile', function($query) {
                $query->where('is_available', true);
            })
            ->paginate(12);
        
        return view('freelancers.index', compact('freelancers'));
    }

    /**
     * Mostrar perfil de un freelancer (público)
     */
    public function show(User $freelancer)
    {
        if (!$freelancer->isFreelancer()) {
            abort(404);
        }

        $freelancer->load('freelancerProfile');
        return view('freelancers.show', compact('freelancer'));
    }

    /**
     * Mostrar formulario de edición de perfil (para freelancers)
     */
    public function edit()
    {
        $user = auth()->user();
        if (!$user->isFreelancer()) {
            abort(403);
        }

        $profile = $user->freelancerProfile;
        return view('freelancers.edit', compact('profile'));
    }

    /**
     * Actualizar perfil de freelancer
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user->isFreelancer()) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'hourly_rate' => 'nullable|numeric|min:0',
            'experience_years' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|string',
            'services' => 'nullable|string',
            'is_available' => 'boolean'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $profile = $user->freelancerProfile;
        if (!$profile) {
            $profile = new FreelancerProfile(['user_id' => $user->id]);
        }

        // Procesar foto si se subió
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $photoPath = $request->file('photo')->store('freelancer-photos', 'public');
            $profile->photo = $photoPath;
        }

        // Procesar skills y services
        $skills = $request->input('skills') ? explode(',', $request->input('skills')) : [];
        $services = $request->input('services') ? explode(',', $request->input('services')) : [];

        $profile->fill([
            'title' => $request->input('title'),
            'bio' => $request->input('bio'),
            'phone' => $request->input('phone'),
            'location' => $request->input('location'),
            'website' => $request->input('website'),
            'linkedin' => $request->input('linkedin'),
            'github' => $request->input('github'),
            'hourly_rate' => $request->input('hourly_rate'),
            'experience_years' => $request->input('experience_years'),
            'skills' => $skills,
            'services' => $services,
            'is_available' => $request->boolean('is_available')
        ]);

        $profile->save();

        return redirect()->route('freelancer.dashboard')->with('success', 'Perfil actualizado exitosamente');
    }

    /**
     * Mostrar dashboard del freelancer autenticado
     */
    public function dashboard()
    {
        $user = auth()->user();
        if (!$user->isFreelancer()) {
            abort(403);
        }

        return view('freelancers.dashboard');
    }

    /**
     * Mostrar perfil del freelancer autenticado
     */
    public function profile()
    {
        $user = auth()->user();
        if (!$user->isFreelancer()) {
            abort(403);
        }

        $profile = $user->freelancerProfile;
        return view('freelancers.profile', compact('profile'));
    }

    /**
     * Vista administrativa de freelancers (solo admin)
     */
    public function admin()
    {
        $freelancers = User::where('role', 'freelancer')
            ->with('freelancerProfile')
            ->paginate(15);
        
        return view('admin.freelancers', compact('freelancers'));
    }

    /**
     * Eliminar freelancer (solo admin)
     */
    public function destroy(User $freelancer)
    {
        if (!$freelancer->isFreelancer()) {
            abort(404);
        }

        // Eliminar foto si existe
        if ($freelancer->freelancerProfile && $freelancer->freelancerProfile->photo) {
            Storage::disk('public')->delete($freelancer->freelancerProfile->photo);
        }

        $freelancer->delete();

        return redirect()->route('admin.freelancers')->with('success', 'Freelancer eliminado exitosamente');
    }
}
