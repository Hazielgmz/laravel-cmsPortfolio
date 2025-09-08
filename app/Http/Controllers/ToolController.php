<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::orderBy('name')->get();
        return view('tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tools.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'nullable|string|max:100',
            'icon' => 'nullable|url',
            'visible' => 'boolean'
        ]);
        Tool::create($data);
        return redirect()->route('tools.index')->with('success', 'Herramienta creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        return view('tools.show', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:100',
            'type' => 'nullable|string|max:100',
            'icon' => 'nullable|url',
            'visible' => 'boolean'
        ]);
        $tool->update($data);
        return redirect()->route('tools.index')->with('success', 'Herramienta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('tools.index')->with('success', 'Herramienta eliminada correctamente');
    }
    
    /**
     * Get all tools.
     */
    public function getAllTools()
    {
        $tools = Tool::orderBy('name')->get();
        return response()->json($tools);
    }
}