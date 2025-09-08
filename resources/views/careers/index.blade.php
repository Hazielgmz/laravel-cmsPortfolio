@extends('layouts.app')

@section('title', 'Gestión de Experiencia Profesional')
@section('header-title', 'Gestión de Experiencia Profesional')

@section('content')
    <div class="careers-container">
        <div class="card">
            {{-- Encabezado --}}
            <div class="card-header">
                <div>
                    <h3 class="card-title">Gestión de Experiencia Profesional</h3>
                    <p class="card-description">Administra tu experiencia laboral y trayectoria profesional</p>
                </div>
                <div class="card-actions">
                    <a href="{{ route('careers.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                        Nueva Experiencia
                    </a>
                </div>
            </div>

            {{-- Tabla con experiencias profesionales --}}
            <div class="card-content">
                <div class="table-container">
                    @if($careers->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 16V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z"/>
                                    <path d="M16 3v4"/>
                                    <path d="M8 3v4"/>
                                    <path d="M12 11h0"/>
                                    <path d="M12 15h0"/>
                                </svg>
                            </div>
                            <h3 class="empty-title">No hay experiencias profesionales registradas</h3>
                            <p class="empty-description">Agrega experiencias laborales para mostrar tu trayectoria profesional.</p>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Puesto</th>
                                    <th>Empresa</th>
                                    <th>Periodo</th>
                                    <th>Estado</th>
                                    <th>Actualizado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($careers as $career)
                                    <tr>
                                        <td>
                                            <div class="project-name">{{ $career->position }}</div>
                                        </td>
                                        <td>{{ $career->company }}</td>
                                        <td>{{ $career->period }}</td>
                                        <td>
                                            <div class="visibility-toggle">
                                                <form action="{{ route('careers.update', $career->id) }}" method="POST" class="toggle-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="position" value="{{ $career->position }}">
                                                    <input type="hidden" name="company" value="{{ $career->company }}">
                                                    <input type="hidden" name="period" value="{{ $career->period }}">
                                                    <input type="hidden" name="description" value="{{ $career->description }}">
                                                    <input type="hidden" name="contact" value="{{ $career->contact }}">
                                                    <input type="hidden" name="visible" value="{{ $career->visible ? '0' : '1' }}">
                                                    <button type="submit" class="toggle-btn {{ $career->visible ? 'toggle-active' : 'toggle-inactive' }}">
                                                        <span class="toggle-slider"></span>
                                                        <span class="toggle-text">{{ $career->visible ? 'Visible' : 'Oculto' }}</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>{{ $career->updated_at->format('d/m/Y') }}</td>
                                        <td class="actions-cell">
                                            <form action="{{ route('careers.destroy', $career->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta experiencia profesional?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon">
                                                        <path d="M3 6h18"></path>
                                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Container */
        .careers-container {
            width: 100%;
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
            border-bottom: 1px solid #2d3748;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        /* Tabla */
        .table-container {
            border: 1px solid #2d3748;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table {
            width: 100%;
            --mdb-table-bg: #1e293b;
            border-collapse: collapse;
        }

        .table th {
            background-color: #1a2234;
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            border-bottom: 1px solid #2d3748;
            text-align: left;
        }

        .table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #2d3748;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #e2e8f0;
        }

        .table tr:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }

        /* Project name */
        .project-name {
            font-weight: 500;
            color: #e2e8f0;
        }

        /* Botones de acción */
        .actions-cell {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-sm {
            padding: 0.375rem 0.625rem;
            font-size: 0.75rem;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-danger {
            background-color: #ef4444;
            display: inline;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;

        }
        
        /* Toggle Switch */
        .visibility-toggle {
            display: flex;
            align-items: center;
        }
        
        .toggle-form {
            margin: 0;
        }
        
        .toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 1rem;
            transition: all 0.2s ease;
        }
        
        .toggle-btn:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .toggle-slider {
            display: inline-block;
            position: relative;
            width: 36px;
            height: 20px;
            border-radius: 10px;
            background-color: #2d3748;
            transition: background-color 0.2s ease;
        }
        
        .toggle-slider:before {
            content: '';
            position: absolute;
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            border-radius: 50%;
            background-color: #94a3b8;
            transition: all 0.2s ease;
        }
        
        .toggle-active .toggle-slider {
            background-color: rgba(16, 185, 129, 0.3);
        }
        
        .toggle-active .toggle-slider:before {
            transform: translateX(16px);
            background-color: #10b981;
        }
        
        .toggle-inactive .toggle-slider {
            background-color: rgba(107, 114, 128, 0.3);
        }
        
        .toggle-text {
            font-size: 0.75rem;
            font-weight: 500;
            color: #e2e8f0;
        }
        
        /* Badges - Mantener por compatibilidad */
        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }
        
        .badge-success {
            color: #fff;
            background-color: #10b981;
        }
        
        .badge-secondary {
            color: #fff;
            background-color: #6b7280;
        }

        .btn-icon {
            flex-shrink: 0;
        }

        .delete-form {
            margin: 0;
        }

        /* Estado vacío */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: rgba(59, 130, 246, 0.1);
            color: #2563eb;
            margin-bottom: 1.5rem;
        }

        .empty-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #e2e8f0;
            margin: 0 0 0.5rem 0;
        }

        .empty-description {
            font-size: 0.875rem;
            color: #94a3b8;
            margin: 0;
            max-width: 400px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .card-actions {
                width: 100%;
            }

            .actions-cell {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar confirmación y animación al cambio de visibilidad
            const toggleForms = document.querySelectorAll('.toggle-form');
            
            toggleForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const isVisible = this.querySelector('input[name="visible"]').value === '1';
                    const newStatus = isVisible ? 'visible' : 'oculta';
                    
                    if (confirm(`¿Cambiar esta experiencia profesional a ${newStatus}?`)) {
                        // Animación previa al envío
                        const toggleBtn = this.querySelector('.toggle-btn');
                        const toggleText = this.querySelector('.toggle-text');
                        
                        if (isVisible) {
                            toggleBtn.classList.remove('toggle-inactive');
                            toggleBtn.classList.add('toggle-active');
                            toggleText.textContent = 'Visible';
                        } else {
                            toggleBtn.classList.remove('toggle-active');
                            toggleBtn.classList.add('toggle-inactive');
                            toggleText.textContent = 'Oculto';
                        }
                        
                        // Pequeña demora para mostrar la animación antes del envío
                        setTimeout(() => {
                            this.submit();
                        }, 300);
                    }
                });
            });
        });
    </script>
@endsection
