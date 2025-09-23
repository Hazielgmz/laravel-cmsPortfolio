<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <title>{{ $title ?? 'Panel' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <style>
        html {
            height: -webkit-fill-available;
        }
        body { 
            margin:0; 
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', Arial, sans-serif; 
            background:#0f172a; 
            color:#FFFFFF; 
            overflow-x: hidden;
        }
        .layout-wrapper { 
            display:flex; 
            min-height:100vh; 
            position: relative;
        }
        
        /* Estilos específicos para móvil */
        @media (max-width: 768px) {
            body {
                min-height: 100vh;
                min-height: -webkit-fill-available;
            }
            .layout-wrapper {
                min-height: -webkit-fill-available;
            }
        }
        .main-content { flex:1; padding:1.25rem 1.5rem; }
        
        /* Estilos para toggle y overlay */
        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 60;
            background: #1e293b;
            border: none;
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(0,0,0,0.25);
            align-items: center;
            justify-content: center;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            transition: transform 0.15s ease, background-color 0.15s ease;
        }
        
        .toggle-sidebar:active {
            transform: scale(0.95);
            background-color: #273548;
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            z-index: 49;
            opacity: 0;
            transition: opacity 0.25s ease;
            touch-action: manipulation;
        }
        
        .sidebar-overlay.active {
            opacity: 1;
            display: block;
        }
        
        .main-content { 
            flex:1; 
            padding:1.25rem 1.5rem; 
        }
        
        @media (max-width: 768px) {
            .toggle-sidebar {
                display: flex;
                top: max(15px, env(safe-area-inset-top, 15px));
                left: max(15px, env(safe-area-inset-left, 15px));
            }
            
            .main-content {
                padding-top: max(75px, calc(60px + env(safe-area-inset-top, 0px)));
                padding-left: max(1.25rem, env(safe-area-inset-left, 1.25rem));
                padding-right: max(1.25rem, env(safe-area-inset-right, 1.25rem));
                padding-bottom: max(1.25rem, env(safe-area-inset-bottom, 1.25rem));
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            
            .page-header h1 {
                font-size: 1.4rem;
            }
        }
        
        /* Restaurando estilos de page-header para escritorio */
        .page-header { 
            display:flex; 
            align-items:center; 
            justify-content:space-between; 
            margin-bottom:1.25rem; 
        }
        
        .page-header h1 { 
            font-size:1.25rem; 
            font-weight:600; 
            margin:0; 
        }
        }
        .page-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:1.25rem; }
        .page-header h1 { font-size:1.25rem; font-weight:600; margin:0; }
        .card { background:#1e293b; border:none; }
        .table thead th { color:#94a3b8; font-weight:500; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px; border-bottom:1px solid rgba(148,163,184,0.15); }
        .table tbody td { vertical-align:middle; font-size:.85rem; }
        a { color:#38bdf8; }
        a:hover { color:#0ea5e9; }
        .btn-primary { background:#3b82f6; }
        .btn-primary:hover { background:#2563eb; }
    </style>
</head>
<body>
    <div class="layout-wrapper">
        <!-- Botón toggle para dispositivo móvil -->
        <button id="toggleSidebar" class="toggle-sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
        
        <!-- Overlay para móvil -->
        <div id="sidebarOverlay" class="sidebar-overlay"></div>
        
        @include('sidebar')
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
    <script>
        // Funcionalidad para el sidebar móvil
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            let touchStartX = 0;
            let touchEndX = 0;
            let touchStartY = 0;
            const body = document.body;
            
            // Función para abrir el sidebar
            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('active');
                body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
                
                // Asegurarse de que el sidebar tenga la altura correcta en móviles
                updateSidebarHeight();
            }
            
            // Función para cerrar el sidebar
            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                body.style.overflow = ''; // Restaurar scroll
            }
            
            // Función para alternar el sidebar
            function toggleSidebar() {
                if (sidebar.classList.contains('open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }
            
            // Actualizar altura del sidebar según la pantalla real
            function updateSidebarHeight() {
                const windowHeight = window.innerHeight;
                // Solo usar clientHeight si tenemos problemas específicos con algunos navegadores
                sidebar.style.height = `${windowHeight}px`;
            }
            
            // Event listeners para clicks
            toggleBtn.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', closeSidebar);
            
            // Soporte para gestos de deslizamiento
            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY; // Capturar Y para evitar confusión con scroll vertical
            }, {passive: true});
            
            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                const touchEndY = e.changedTouches[0].screenY;
                const verticalDistance = Math.abs(touchEndY - touchStartY);
                
                // Solo procesar swipes horizontales (ignorar scrolls verticales)
                if (verticalDistance < 50) {
                    handleSwipe();
                }
            }, {passive: true});
            
            function handleSwipe() {
                const swipeDistance = touchEndX - touchStartX;
                // Para dispositivos móviles solamente
                if (window.innerWidth <= 768) {
                    // Deslizar desde el borde izquierdo para abrir (cuando está cerrado)
                    if (swipeDistance > 70 && touchStartX < 30 && !sidebar.classList.contains('open')) {
                        openSidebar();
                    }
                    // Deslizar hacia la izquierda para cerrar (cuando está abierto)
                    else if (swipeDistance < -50 && sidebar.classList.contains('open')) {
                        closeSidebar();
                    }
                }
            }
            
            // Manejar cambios de orientación y redimensionamiento
            function handleResize() {
                updateSidebarHeight();
                
                // Cerrar sidebar si cambiamos a desktop
                if (window.innerWidth > 768 && sidebar.classList.contains('open')) {
                    closeSidebar();
                }
            }
            
            // Eventos de redimensionamiento y orientación
            window.addEventListener('resize', handleResize);
            window.addEventListener('orientationchange', function() {
                // Pequeña demora para permitir que la orientación se complete
                setTimeout(updateSidebarHeight, 100);
            });
            
            // Inicializar altura solo en móvil
            if (window.innerWidth <= 768) {
                updateSidebarHeight();
            } else {
                // En escritorio, usar altura nativa
                sidebar.style.height = '';
                sidebar.style.position = '';
            }
            
            // Manejar el teclado virtual en móviles
            const originalHeight = window.innerHeight;
            window.addEventListener('resize', function() {
                // Solo aplicar en móvil
                if (window.innerWidth <= 768) {
                    // Si la altura disminuye significativamente, probablemente es el teclado
                    if (window.innerHeight < originalHeight * 0.75) {
                        // Ajustar para que el sidebar se desplace si el teclado está abierto
                        sidebar.style.height = '100%';
                        sidebar.style.position = 'absolute';
                    } else {
                        // Restaurar altura completa y posición fija
                        sidebar.style.height = `${window.innerHeight}px`;
                        sidebar.style.position = 'fixed';
                    }
                } else {
                    // En escritorio, usar valores CSS por defecto
                    sidebar.style.height = '';
                    sidebar.style.position = '';
                }
            });
        });
    </script>
</body>
</html>
