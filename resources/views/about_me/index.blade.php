@extends('layouts.app')

@section('title', 'Editar Perfil')
@section('header-title', 'Editar Perfil')

@section('content')
    <div class="profile-container">
        <div class="card">
            {{-- Encabezado --}}
            <div class="card-header">
                <div>
                    <h3 class="card-title">Editar Perfil</h3>
                    <p class="card-description">Actualiza tu información personal</p>
                </div>
            </div>

            <div class="card-content">
                <form action="{{ route('about-me.update', $record->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name', $record->name) }}"
                            class="form-input" 
                            required
                        >
                    </div>

                    {{-- Biografía --}}
                    <div class="form-group">
                        <label for="bio" class="form-label">Biografía</label>
                        <textarea 
                            name="bio" 
                            id="bio" 
                            rows="4" 
                            class="form-input"
                        >{{ old('bio', $record->bio) }}</textarea>
                    </div>

                    {{-- Foto --}}
                    <div class="form-group">
                        <label for="profile_image" class="form-label">URL de Foto</label>
                        <input 
                            type="url" 
                            name="profile_image" 
                            id="profile_image"
                            value="{{ old('profile_image', $record->profile_image) }}"
                            class="form-input"
                        >
                        @if($record->profile_image)
                            <div class="preview">
                                <img src="{{ $record->profile_image }}" alt="Foto de perfil" class="preview-img">
                            </div>
                        @endif
                    </div>

                    {{-- Acciones --}}
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('about-me.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Container */
        .profile-container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .card {
            background: #1e293b;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        /* Header */
        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: #e2e8f0;
        }

        .card-description {
            font-size: 0.875rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        /* Content */
        .card-content {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .form-input, textarea.form-input {
            width: 100%;
            padding: 0.625rem 0.75rem;
            border: 1px solid #2d3748;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            background-color: #1a2234;
            color: #e2e8f0;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus, textarea.form-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
        }

        .preview {
            margin-top: 0.75rem;
        }

        .preview-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #2d3748;
        }

        /* Actions */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: background-color 0.2s ease;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #4b5563;
            color: #e2e8f0;
        }

        .btn-secondary:hover {
            background-color: #6b7280;
        }
    </style>
@endsection
