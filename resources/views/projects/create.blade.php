@extends('layouts.app')

@section('title', 'Crear Proyecto')
@section('header-title', 'Crear Proyecto')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Nuevo Proyecto</h3>
                        <p class="card-description">Agrega un nuevo proyecto a tu portfolio</p>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="codeLink" class="form-label">Enlace al código</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-github"></i></span>
                                <input type="url" class="form-control" id="codeLink" name="codeLink" value="{{ old('codeLink') }}">
                            </div>
                            <small class="text-muted">URL del repositorio (GitHub, GitLab, etc.)</small>
                            @error('codeLink')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="PreviewLink" class="form-label">Enlace a la demo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                <input type="url" class="form-control" id="PreviewLink" name="PreviewLink" value="{{ old('PreviewLink') }}">
                            </div>
                            <small class="text-muted">URL para ver el proyecto en funcionamiento</small>
                            @error('PreviewLink')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="form-label">URL de la imagen</label>
                            <input type="url" class="form-control" id="image" name="image" value="{{ old('image') }}">
                            <small class="text-muted">URL de la imagen de previsualización del proyecto</small>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible">Visible en portfolio</label>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Tecnologías utilizadas</label>
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
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
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
    .form-control, .form-select, .input-group-text {
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
    
    .input-group-text {
        border-right: none;
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