<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = AboutMe::first();
        return view('about_me.index', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|string'
        ]);

        $existing = AboutMe::first();
        if ($existing) {
            $existing->update($data);
            return redirect()->route('about-me.index')->with('success', 'Información actualizada correctamente');
        }

        AboutMe::create($data);
        return redirect()->route('about-me.index')->with('success', 'Información creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutMe $aboutMe)
    {
        return view('about_me.show', compact('aboutMe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutMe $aboutMe)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|string'
        ]);
        
        $aboutMe->update($data);
        return redirect()->route('about-me.index')->with('success', 'Información actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutMe $aboutMe)
    {
        $aboutMe->delete();
        return redirect()->route('about-me.index')->with('success', 'Información eliminada correctamente');
    }
}