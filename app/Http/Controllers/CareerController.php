<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::orderByDesc('created_at')->paginate(10);
        return view('careers.index', compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('careers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'position' => 'required|string',
            'company' => 'required|string',
            'period' => 'required|string',
            'description' => 'required|string',
            'contact' => 'nullable|string',
            'visible' => 'boolean'
        ]);
        
        Career::create($data);
        return redirect()->route('careers.index')->with('success', 'Career entry created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        return view('careers.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        return view('careers.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        $data = $request->validate([
            'position' => 'sometimes|required|string',
            'company' => 'sometimes|required|string',
            'period' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'contact' => 'nullable|string',
            'visible' => 'boolean'
        ]);
        
        $career->update($data);
        return redirect()->route('careers.index')->with('success', 'Career entry updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.index')->with('success', 'Career entry deleted successfully');
    }
}
