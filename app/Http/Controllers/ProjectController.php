<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tool;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $projects = Project::orderByDesc('created_at')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tools = Tool::orderBy('name')->get();
        return view('projects.create', compact('tools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'codeLink' => 'nullable|url',
            'PreviewLink' => 'nullable|url',
            'image' => 'nullable|url',
            'visible' => 'boolean',
            'tools' => 'nullable|array',
            'tools.*' => 'exists:tools,id'
        ]);
        
        $project = Project::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'codeLink' => $data['codeLink'] ?? null,
            'PreviewLink' => $data['PreviewLink'] ?? null,
            'image' => $data['image'] ?? null,
            'visible' => isset($data['visible']) ? true : false,
        ]);
        
        if (isset($data['tools'])) {
            $project->tools()->attach($data['tools']);
        }
        
        return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'codeLink' => 'nullable|url',
            'PreviewLink' => 'nullable|url',
            'image' => 'nullable|url',
            'visible' => 'boolean',
            'tools' => 'nullable|array',
            'tools.*' => 'exists:tools,id'
        ]);
        
        $project->update([
            'title' => $data['title'] ?? $project->title,
            'description' => $data['description'] ?? $project->description,
            'codeLink' => $data['codeLink'] ?? $project->codeLink,
            'PreviewLink' => $data['PreviewLink'] ?? $project->PreviewLink,
            'image' => $data['image'] ?? $project->image,
            'visible' => isset($data['visible']) ? true : false,
        ]);
        
        if (isset($data['tools'])) {
            $project->tools()->sync($data['tools']);
        }
        
        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente');
    }
    
    /**
     * Get tools associated with a project.
     */
    public function getTools(Project $project)
    {
        $projectTools = $project->tools()->pluck('id')->toArray();
        $allTools = Tool::orderBy('name')->get();
        
        return response()->json([
            'projectTools' => $projectTools,
            'allTools' => $allTools
        ]);
    }
}