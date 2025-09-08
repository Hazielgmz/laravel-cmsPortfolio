@extends('layouts.app')

@section('title', 'Crear Certificado')
@section('header-title', 'Crear Certificado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Nuevo Certificado</h3>
                        <p class="card-description">Agrega un nuevo certificado o curso a tu portfolio</p>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('certificates.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="issuer" class="form-label">Emisor</label>
                            <input type="text" class="form-control" id="issuer" name="issuer" value="{{ old('issuer') }}" required>
                            @error('issuer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Seleccionar tipo</option>
                                <option value="Curso" {{ old('type') == 'Curso' ? 'selected' : '' }}>Curso</option>
                                <option value="Certificación" {{ old('type') == 'Certificación' ? 'selected' : '' }}>Certificación</option>
                                <option value="Diploma" {{ old('type') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="Otro" {{ old('type') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="date" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="certificate_url" class="form-label">URL del Certificado</label>
                            <input type="url" class="form-control" id="certificate_url" name="certificate_url" value="{{ old('certificate_url') }}">
                            <small class="text-muted">Enlace para verificar el certificado (opcional)</small>
                            @error('certificate_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible">Visible en portfolio</label>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Tecnologías relacionadas</label>
                            <div class="tools-selection">
                                @foreach($tools as $tool)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tools[]" id="tool-{{ $tool->id }}" value="{{ $tool->id }}" {{ in_array($tool->id, old('tools', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tool-{{ $tool->id }}">
                                        {{ $tool->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('certificates.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Certificado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-control, .form-select {
        background-color: #1a2234;
        border: 1px solid #2d3748;
        color: #e2e8f0;
    }
    
    .form-control:focus, .form-select:focus {
        background-color: #1a2234;
        border-color: #3b82f6;
        color: #e2e8f0;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
    }
    
    .form-label {
        color: #94a3b8;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    .btn-outline-secondary {
        border-color: #4b5563;
        color: #e2e8f0;
    }
    
    .btn-outline-secondary:hover {
        background-color: #4b5563;
        color: #e2e8f0;
    }
    
    .form-check-input {
        background-color: #1a2234;
        border-color: #4b5563;
    }
    
    .form-check-input:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    
    .text-muted {
        color: #64748b !important;
    }
</style>
@endsection