@extends('layouts.app')

@section('title', 'Certificados')
@section('header-title', 'Certificados')

@section('content')
    <div class="certificates-container">
        <div class="card">
            {{-- Encabezado --}}
            <div class="card-header">
                <div>
                    <h3 class="card-title">Certificados</h3>
                    <p class="card-description">Gestiona tus certificaciones y cursos</p>
                </div>
                <div class="card-actions">
                    <a href="{{ route('certificates.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                        Nuevo Certificado
                    </a>
                </div>
            </div>

            {{-- Tabla con certificados --}}
            <div class="card-content">
                <div class="table-container">
                    @if($certs->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="14" x="3" y="4" rx="2"></rect>
                                    <line x1="12" x2="12" y1="2" y2="4"></line>
                                    <line x1="12" x2="12" y1="18" y2="20"></line>
                                    <circle cx="12" cy="11" r="3"></circle>
                                    <path d="M11 8a7.5 7.5 0 1 0 10 0"></path>
                                </svg>
                            </div>
                            <h3 class="empty-title">No hay certificados registrados</h3>
                            <p class="empty-description">Agrega tus certificados y cursos para mostrar tus habilidades.</p>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Emisor</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Visible</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certs as $c)
                                    <tr>
                                        <td>
                                            <div class="certificate-name">{{ $c->title }}</div>
                                        </td>
                                        <td>
                                            <span class="issuer">{{ $c->issuer }}</span>
                                        </td>
                                        <td>{{ $c->type ?? '—' }}</td>
                                        <td>{{ $c->date?->format('d/m/Y') ?? '—' }}</td>
                                        <td>
                                            <div class="visibility-toggle">
                                                <form action="{{ route('certificates.update', $c->id) }}" method="POST" class="toggle-form">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="title" value="{{ $c->title }}">
                                                    <input type="hidden" name="issuer" value="{{ $c->issuer }}">
                                                    <input type="hidden" name="type" value="{{ $c->type }}">
                                                    <input type="hidden" name="date" value="{{ $c->date?->format('Y-m-d') }}">
                                                    <input type="hidden" name="certificate_url" value="{{ $c->certificate_url }}">
                                                    <input type="hidden" name="visible" value="{{ $c->visible ? '0' : '1' }}">
                                                    <button type="submit" class="toggle-btn {{ $c->visible ? 'toggle-active' : 'toggle-inactive' }}">
                                                        <span class="toggle-slider"></span>
                                                        <span class="toggle-text">{{ $c->visible ? 'Visible' : 'Oculto' }}</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="actions-cell">
                                            
                                            <form action="{{ route('certificates.destroy', $c->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este certificado?')"
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
                        @if(method_exists($certs, 'links'))
                        <div class="pagination-container">
                            {{ $certs->links() }}
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>



    {{-- Modal para Editar Certificado --}}
    <div class="modal fade" id="editCertificateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header border-dark">
                    <h5 class="modal-title text-light">Editar Certificado</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCertificateForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title" class="form-label">Título</label>
                            <input type="text" name="title" id="edit_title" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_issuer" class="form-label">Emisor</label>
                            <input type="text" name="issuer" id="edit_issuer" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_type" class="form-label">Tipo</label>
                            <input type="text" name="type" id="edit_type" class="form-input" placeholder="Ej: Curso, Diplomado, Certificación">
                        </div>
                        <div class="form-group">
                            <label for="edit_date" class="form-label">Fecha de Obtención</label>
                            <input type="date" name="date" id="edit_date" class="form-input">
                        </div>
                        <div class="form-group">
                            <label for="edit_certificate_url" class="form-label">URL del Certificado</label>
                            <input type="url" name="certificate_url" id="edit_certificate_url" class="form-input" placeholder="Enlace al PDF o credencial">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="visible" id="edit_visible" class="form-check-input">
                            <label for="edit_visible" class="form-check-label">Certificado Visible</label>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Tecnologías relacionadas</label>
                            <div class="tools-selection" id="edit_tools_container">
                                <!-- Las herramientas se cargarán dinámicamente con JavaScript -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Certificado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Container */
        .certificates-container {
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

        

        /* Certificados */
        .certificate-name {
            font-weight: 500;
            color: #e2e8f0;
        }

        .issuer {
            color: #94a3b8;
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
            display: inline;
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
            background-color: #1a2234;
            border: 1px solid #2d3748;
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
            const editButtons = document.querySelectorAll('.edit-certificate-btn');
            const editForm = document.getElementById('editCertificateForm');
            const toolsContainer = document.getElementById('edit_tools_container');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const title = this.dataset.title;
                    const issuer = this.dataset.issuer;
                    const type = this.dataset.type;
                    const date = this.dataset.date;
                    const url = this.dataset.url;
                    const visible = this.dataset.visible === '1';
                    
                    // Establecer la acción del formulario
                    editForm.action = `/certificates/${id}`;
                    
                    // Rellenar los campos
                    document.getElementById('edit_title').value = title;
                    document.getElementById('edit_issuer').value = issuer;
                    document.getElementById('edit_type').value = type || '';
                    document.getElementById('edit_date').value = date || '';
                    document.getElementById('edit_certificate_url').value = url || '';
                    document.getElementById('edit_visible').checked = visible;
                    
                    // Cargar herramientas asociadas
                    loadCertificateTools(id);
                });
            });
            
            // Función para cargar herramientas del certificado
            function loadCertificateTools(certificateId) {
                fetch(`/certificates/${certificateId}/tools`)
                    .then(response => response.json())
                    .then(data => {
                        toolsContainer.innerHTML = '';
                        
                        data.allTools.forEach(tool => {
                            const isChecked = data.certificateTools.includes(tool.id);
                            
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