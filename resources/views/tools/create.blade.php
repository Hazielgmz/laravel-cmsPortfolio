@extends('layouts.app')

@section('title', 'Crear Herramienta')
@section('header-title', 'Crear Herramienta')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Nueva Herramienta</h3>
                        <p class="card-description">Agrega una nueva tecnología o herramienta a tu portfolio</p>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('tools.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">Seleccionar tipo</option>
                                <option value="Frontend" {{ old('type') == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                                <option value="Backend" {{ old('type') == 'Backend' ? 'selected' : '' }}>Backend</option>
                                <option value="Framework" {{ old('type') == 'Framework' ? 'selected' : '' }}>Framework</option>
                                <option value="Database" {{ old('type') == 'Database' ? 'selected' : '' }}>Database</option>
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="icon" class="form-label">URL del icono</label>
                            <input type="url" class="form-control" id="icon" name="icon" value="{{ old('icon') }}">
                            <small class="text-muted">URL de una imagen representativa de la herramienta (opcional)</small>
                            @error('icon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible">Visible en portfolio</label>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('tools.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Herramienta</button>
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
    
    input[type="file"].form-control {
        padding: 0.375rem 0.75rem;
    }
    
    input[type="file"].form-control::file-selector-button {
        background-color: #2d3748;
        color: #e2e8f0;
        border: 0;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        margin-right: 0.75rem;
    }
</style>
@endsection