@extends('layouts.app')

@section('title', 'Herramientas')
@section('header-title', 'Herramientas')

@section('content')
    <div class="tools-container">
        <div class="card">
            {{-- Encabezado --}}
            <div class="card-header">
                <div>
                    <h3 class="card-title">Herramientas y Tecnologías</h3>
                    <p class="card-description">Gestiona las tecnologías que utilizas en tus proyectos</p>
                </div>
                <div class="card-actions">
                    <a href="{{ route('tools.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                        Nueva Herramienta
                    </a>
                </div>
            </div>

            {{-- Grid de herramientas --}}
            <div class="card-content">
                @if($tools->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                        </div>
                        <h3 class="empty-title">No hay herramientas registradas</h3>
                        <p class="empty-description">Agrega tecnologías y herramientas para mostrar tus habilidades técnicas.</p>
                    </div>
                @else
                    <div class="tools-grid">
                        @foreach($tools as $tool)
                            <div class="tool-card">
                                <div class="tool-content">
                                    @if($tool->icon)
                                        <div class="tool-icon">
                                            <img src="{{ $tool->icon }}" alt="{{ $tool->name }}">
                                        </div>
                                    @else
                                        <div class="tool-icon tool-icon-placeholder">
                                            {{ substr($tool->name, 0, 2) }}
                                        </div>
                                    @endif
                                    
                                    <div class="tool-info">
                                        <h4 class="tool-name">{{ $tool->name }}</h4>
                                        @if($tool->type)
                                            <p class="tool-type">{{ $tool->type }}</p>
                                        @endif
                                        <span class="badge {{ $tool->visible ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $tool->visible ? 'Visible' : 'Oculto' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="tool-actions">
                                    <form action="{{ route('tools.update', $tool->id) }}" method="POST" class="toggle-form">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name" value="{{ $tool->name }}">
                                        <input type="hidden" name="type" value="{{ $tool->type }}">
                                        <input type="hidden" name="icon" value="{{ $tool->icon }}">
                                        <input type="hidden" name="visible" value="{{ $tool->visible ? '0' : '1' }}">
                                        <button type="submit" class="btn visibility-btn {{ $tool->visible ? 'btn-success' : 'btn-secondary' }} btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon">
                                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            {{ $tool->visible ? 'Visible' : 'Oculto' }}
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('tools.destroy', $tool->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta herramienta?')"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>


    {{-- Modal para Editar Herramienta --}}
    <div class="modal fade" id="editToolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header border-dark">
                    <h5 class="modal-title text-light">Editar Herramienta</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editToolForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="edit_name" class="form-input" required placeholder="Ej: Laravel, React, PostgreSQL">
                        </div>
                        <div class="form-group">
                            <label for="edit_type" class="form-label">Tipo</label>
                            <select name="type" id="edit_type" class="form-input">
                                <option value="">Seleccionar tipo</option>
                                <option value="Frontend">Frontend</option>
                                <option value="Backend">Backend</option>
                                <option value="Framework">Framework</option>
                                <option value="Database">Database</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_icon" class="form-label">URL del Icono</label>
                            <input type="url" name="icon" id="edit_icon" class="form-input" placeholder="URL de una imagen SVG o PNG">
                            <div id="icon_preview" class="icon-preview mt-2 d-none">
                                <img src="" alt="Vista previa" class="icon-preview-img">
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="visible" id="edit_visible" class="form-check-input">
                            <label for="edit_visible" class="form-check-label">Herramienta Visible</label>
                        </div>
                    </div>
                    <div class="modal-footer border-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Herramienta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Container */
        .tools-container {
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

        /* Grid de herramientas */
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .tool-card {
            border: 1px solid #2d3748;
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: #1a2234;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .tool-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tool-content {
            padding: 1rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .tool-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            flex-shrink: 0;
        }

        .tool-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .tool-icon-placeholder {
            font-weight: 600;
            font-size: 1.25rem;
            color: #4b5563;
            text-transform: uppercase;
        }

        .tool-info {
            flex: 1;
        }

        .tool-name {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 0.25rem 0;
            color: #ffffff;
        }

        .tool-type {
            font-size: 0.75rem;
            color: #9fa6b2;
            margin: 0 0 0.5rem 0;
        }

        .tool-actions {
            display: flex;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background-color: #1a2234;
            border-top: 1px solid #2d3748;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: #10b981;
            color: white;
        }

        .badge-secondary {
            background-color: #6b7280;
            color: white;
        }

        /* Botones */
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
            flex: 1;
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
        
        .btn-success {
            background-color: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #059669;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-icon {
            flex-shrink: 0;
        }

        .delete-form {
            margin: 0;
            flex: 1;
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

        /* Form */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.625rem 0.75rem;
            border: 1px solid #2d3748;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #1a2234;
            color: #e2e8f0;
        }

        .form-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
        }
        
        /* Select styling */
        select.form-input {
            appearance: auto;
        }
        
        select.form-input option {
            background-color: #1a2234;
            color: #e2e8f0;
        }

        /* Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-input {
            width: 1rem;
            height: 1rem;
        }

        .form-check-label {
            font-size: 0.875rem;
        }

        /* Icon Preview */
        .icon-preview {
            margin-top: 0.5rem;
        }

        .icon-preview-img {
            width: 40px;
            height: 40px;
            border-radius: 0.25rem;
            object-fit: contain;
            border: 1px solid #e5e7eb;
            padding: 0.25rem;
            background-color: #f9fafb;
        }

        /* Utils */
        .mt-2 {
            margin-top: 0.5rem;
        }

        .d-none {
            display: none;
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

            .card-actions .btn {
                width: 100%;
            }

            .tools-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .tool-actions {
                flex-direction: column;
            }

            .btn-sm {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar el modal de edición (se mantiene para uso interno)
            const editButtons = document.querySelectorAll('.edit-tool-btn');
            const editForm = document.getElementById('editToolForm');
            const iconPreview = document.getElementById('icon_preview');
            const iconPreviewImg = document.querySelector('.icon-preview-img');
            
            if (editButtons.length > 0 && editForm) {
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const name = this.dataset.name;
                        const type = this.dataset.type;
                        const icon = this.dataset.icon;
                        const visible = this.dataset.visible === '1';
                        
                        // Establecer la acción del formulario
                        editForm.action = `/tools/${id}`;
                        
                        // Rellenar los campos
                        document.getElementById('edit_name').value = name;
                        
                        // Set the type dropdown value
                        const typeSelect = document.getElementById('edit_type');
                        if (type && ['Frontend', 'Backend', 'Framework', 'Database'].includes(type)) {
                            typeSelect.value = type;
                        } else {
                            typeSelect.value = '';
                        }
                        
                        document.getElementById('edit_icon').value = icon || '';
                        document.getElementById('edit_visible').checked = visible;
                        
                        // Mostrar vista previa del icono si existe
                        if (icon) {
                            iconPreviewImg.src = icon;
                            iconPreview.classList.remove('d-none');
                        } else {
                            iconPreview.classList.add('d-none');
                        }
                    });
                });
                
                // Actualizar vista previa cuando se cambia la URL del icono
                document.getElementById('edit_icon').addEventListener('input', function() {
                    const iconUrl = this.value;
                    if (iconUrl) {
                        iconPreviewImg.src = iconUrl;
                        iconPreview.classList.remove('d-none');
                    } else {
                        iconPreview.classList.add('d-none');
                    }
                });
            }
            
            // Manejar los toggles de visibilidad
            const toggleForms = document.querySelectorAll('.toggle-form');
            
            toggleForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const isVisible = this.querySelector('input[name="visible"]').value === '1';
                    const newStatus = isVisible ? 'visible' : 'oculta';
                    
                    if (confirm(`¿Cambiar esta herramienta a ${newStatus}?`)) {
                        // Animación previa al envío
                        const button = this.querySelector('button');
                        
                        if (isVisible) {
                            button.classList.remove('btn-secondary');
                            button.classList.add('btn-success');
                            button.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Visible
                            `;
                        } else {
                            button.classList.remove('btn-success');
                            button.classList.add('btn-secondary');
                            button.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Oculto
                            `;
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
