@extends('layouts.app')

@section('title', 'Nueva Experiencia Profesional')
@section('header-title', 'Nueva Experiencia Profesional')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Nueva Experiencia Profesional</h3>
                        <p class="card-description">Agrega una nueva experiencia laboral a tu portfolio</p>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('careers.index') }}" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Volver al listado
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('careers.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="position" class="form-label">Puesto</label>
                            <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" required>
                            @error('position')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="company" class="form-label">Empresa</label>
                            <input type="text" class="form-control" id="company" name="company" value="{{ old('company') }}" required>
                            @error('company')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="period" class="form-label">Periodo de Tiempo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" id="period" name="period" 
                                    value="{{ old('period') }}" placeholder="Ej: Enero 2020 - Presente" required>
                            </div>
                            @error('period')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            <small class="text-muted">Describe tus responsabilidades y logros</small>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="contact" class="form-label">Contacto (Opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="contact" name="contact" 
                                    value="{{ old('contact') }}" placeholder="Información de contacto o referencia">
                            </div>
                            <small class="text-muted">Información de contacto o enlace de referencia</small>
                            @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
                            <label class="form-check-label" for="visible">Visible en portfolio</label>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('careers.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                                Guardar Experiencia
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control {
        background-color: #1a2234;
        border: 1px solid #2d3748;
        color: #e2e8f0;
    }
    .form-control:focus {
        background-color: #1a2234;
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        color: #e2e8f0;
    }
    .input-group-text {
        background-color: #2d3748;
        border: 1px solid #2d3748;
        color: #94a3b8;
    }
    .text-muted {
        color: #94a3b8 !important;
    }
    
    /* Estilos para el switch de visibilidad */
    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-check-input {
        width: 3em;
        height: 1.5em;
        background-color: #2d3748;
        border-color: #4b5563;
        margin-top: 0;
        position: relative;
    }
    
    .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
        border-color: #10b981;
        outline: none;
    }
    
    .form-check-label {
        color: #e2e8f0;
        font-weight: 500;
    }
    
    .form-switch .form-check-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }
    
    .form-switch .form-check-input:checked {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }
</style>
@endsection
