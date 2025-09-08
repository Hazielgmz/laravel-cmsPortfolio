<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Tool;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certs = Certificate::orderByDesc('date')->paginate(15);
        return view('certificates.index', compact('certs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tools = Tool::orderBy('name')->get();
        return view('certificates.create', compact('tools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'date' => 'nullable|date',
            'certificate_url' => 'nullable|url',
            'visible' => 'boolean',
            'tools' => 'nullable|array',
            'tools.*' => 'exists:tools,id'
        ]);
        
        $certificate = Certificate::create([
            'title' => $data['title'],
            'issuer' => $data['issuer'],
            'type' => $data['type'] ?? null,
            'date' => $data['date'] ?? null,
            'certificate_url' => $data['certificate_url'] ?? null,
            'visible' => isset($data['visible']) ? true : false,
        ]);
        
        if (isset($data['tools'])) {
            $certificate->tools()->attach($data['tools']);
        }
        
        return redirect()->route('certificates.index')->with('success', 'Certificado creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'issuer' => 'sometimes|required|string|max:255',
            'type' => 'nullable|string|max:100',
            'date' => 'nullable|date',
            'certificate_url' => 'nullable|url',
            'visible' => 'boolean',
            'tools' => 'nullable|array',
            'tools.*' => 'exists:tools,id'
        ]);
        
        $certificate->update([
            'title' => $data['title'] ?? $certificate->title,
            'issuer' => $data['issuer'] ?? $certificate->issuer,
            'type' => $data['type'] ?? $certificate->type,
            'date' => $data['date'] ?? $certificate->date,
            'certificate_url' => $data['certificate_url'] ?? $certificate->certificate_url,
            'visible' => isset($data['visible']) ? true : false,
        ]);
        
        if (isset($data['tools'])) {
            $certificate->tools()->sync($data['tools']);
        }
        
        return redirect()->route('certificates.index')->with('success', 'Certificado actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('certificates.index')->with('success', 'Certificado eliminado correctamente');
    }
    
    /**
     * Get tools associated with a certificate.
     */
    public function getTools(Certificate $certificate)
    {
        $certificateTools = $certificate->tools()->pluck('id')->toArray();
        $allTools = Tool::orderBy('name')->get();
        
        return response()->json([
            'certificateTools' => $certificateTools,
            'allTools' => $allTools
        ]);
    }
}