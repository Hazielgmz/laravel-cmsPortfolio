@extends('layouts.app')

@section('title', 'Gestión de Proyectos')
@section('header-title', 'Gestión de Proyectos')

@section('content')
    <div class="projects-container">
        <div class="card">
            {{-- Encabezado --}}
            <div class="card-header">
                <div>
                    <h3 class="card-title">Gestión de Proyectos</h3>
                    <p class="card-description">Administra tus proyectos de portfolio</p>
                </div>
                <div class="card-actions">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                        Nuevo Proyecto
                    </a>
                </div>
            </div>

            {{-- Tabla con proyectos --}}
            <div class="card-content">
                <div class="table-container">
                    @if($projects->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            </div>
                            <h3 class="empty-title">No hay proyectos registrados</h3>
                            <p class="empty-description">Agrega proyectos a tu portfolio para mostrarlos en tu página web.</p>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Visible</th>
                                    <th>Enlaces</th>
                                    <th>Actualizado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $p)
                                    <tr>
                                        <td>
                                            <div class="project-name">{{ $p->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $p->visible ? 'badge-success' : 'badge-secondary' }}">
                                                {{ $p->visible ? 'Visible' : 'Oculto' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="project-links">
                                                @if($p->codeLink)
                                                    <a href="{{ $p->codeLink }}" target="_blank" class="project-link">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                                        </svg>
                                                        Código
                                                    </a>
                                                @endif
                                                
                                                @if($p->PreviewLink)
                                                    <a href="{{ $p->PreviewLink }}" target="_blank" class="project-link">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                                            <polyline points="15 3 21 3 21 9"></polyline>
                                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                                        </svg>
                                                        Demo
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $p->updated_at->diffForHumans() }}</td>
                                        <td class="actions-cell">
                                            <button type="button" class="btn btn-primary btn-sm edit-project-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editProjectModal" 
                                                    data-id="{{ $p->id }}"
                                                    data-title="{{ $p->title }}"
                                                    data-description="{{ $p->description }}"
                                                    data-code-link="{{ $p->codeLink }}"
                                                    data-preview-link="{{ $p->PreviewLink }}"
                                                    data-image="{{ $p->image }}"
                                                    data-visible="{{ $p->visible }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="btn-icon">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                                Editar
                                            </button>
                                            
                                            <form action="{{ route('projects.destroy', $p->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?')"
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    {{-- Modal para Editar Proyecto --}}
    <div class="modal fade" id="editProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header border-dark">
                    <h5 class="modal-title text-light">Editar Proyecto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProjectForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title" class="form-label">Título</label>
                            <input type="text" name="title" id="edit_title" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description" class="form-label">Descripción</label>
                            <textarea name="description" id="edit_description" rows="4" class="form-input" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_codeLink" class="form-label">Enlace al Código</label>
                            <input type="url" name="codeLink" id="edit_codeLink" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="edit_PreviewLink" class="form-label">Enlace de Preview</label>
                            <input type="url" name="PreviewLink" id="edit_PreviewLink" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="edit_image" class="form-label">URL de Imagen</label>
                            <input type="url" name="image" id="edit_image" class="form-input">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="visible" id="edit_visible" class="form-check-input">
                            <label for="edit_visible" class="form-check-label">Proyecto Visible</label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tecnologías utilizadas</label>
                            <div class="tools-selection" id="edit_tools_container">
                                <!-- Las herramientas se cargarán dinámicamente con JavaScript -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Container */
        .projects-container {
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

        /* Proyectos */
        .project-name {
            font-weight: 500;
            color: #e2e8f0;
        }

        .project-links {
            display: flex;
            gap: 1rem;
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.75rem;
            color: #38bdf8;
            text-decoration: none;
        }

        .project-link:hover {
            text-decoration: underline;
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

        .btn-secondary {
            background-color: #4b5563;
            color: #e2e8f0;
        }

        .btn-secondary:hover {
            background-color: #6b7280;
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
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.625rem 0.75rem;
            border: 1px solid #2d3748;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            background-color: #1a2234;
            color: #e2e8f0;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
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
            color: #e2e8f0;
        }

        /* Paginación */
        .pagination-container {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
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
            // Manejar el modal de edición
            const editButtons = document.querySelectorAll('.edit-project-btn');
            const editForm = document.getElementById('editProjectForm');
            const toolsContainer = document.getElementById('edit_tools_container');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const title = this.dataset.title;
                    const description = this.dataset.description;
                    const codeLink = this.dataset.codeLink;
                    const previewLink = this.dataset.previewLink;
                    const image = this.dataset.image;
                    const visible = this.dataset.visible === '1';
                    
                    // Establecer la acción del formulario
                    editForm.action = `/projects/${id}`;
                    
                    // Rellenar los campos
                    document.getElementById('edit_title').value = title;
                    document.getElementById('edit_description').value = description;
                    document.getElementById('edit_codeLink').value = codeLink || '';
                    document.getElementById('edit_PreviewLink').value = previewLink || '';
                    document.getElementById('edit_image').value = image || '';
                    document.getElementById('edit_visible').checked = visible;
                    
                    // Cargar herramientas asociadas
                    loadProjectTools(id);
                });
            });
            
            // Función para cargar herramientas del proyecto
            function loadProjectTools(projectId) {
                fetch(`/projects/${projectId}/tools`)
                    .then(response => response.json())
                    .then(data => {
                        toolsContainer.innerHTML = '';
                        
                        data.allTools.forEach(tool => {
                            const isChecked = data.projectTools.includes(tool.id);
                            
                            const checkbox = document.createElement('div');
                            checkbox.className = 'form-check form-check-inline';
                            checkbox.innerHTML = `
                                <input class="form-check-input" type="checkbox" name="tools[]" 
                                       id="edit_tool-${tool.id}" value="${tool.id}" ${isChecked ? 'checked' : ''}>
                                <label class="form-check-label" for="edit_tool-${tool.id}">
                                    ${tool.name}
                                </label>
                            `;
                            toolsContainer.appendChild(checkbox);
                        });
                    })
                    .catch(error => console.error('Error cargando herramientas:', error));
            }
        });
    </script>
@endsection