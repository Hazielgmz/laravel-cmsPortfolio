<div class="sidebar">
    <style>
        .sidebar {
            width: 270px;
            height: inherit;
            background-color: #1e293b;
            color: #e2e8f0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
        }

        .sidebar-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .sidebar-content {
            flex: 1;
            padding: 0.75rem 0;
            display: flex;
            flex-direction: column;
        }

        .menu-group-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            padding: 0.5rem 1rem;
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.65rem 1.1rem;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: 0.18s background, 0.18s color, 0.18s border-color;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            border-left-color: #3b82f6;
            color: #fff;
        }

        .menu-item svg {
            width: 18px;
            height: 18px;
        }

        .sidebar-footer {
            padding: 0.85rem 1rem 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .logout-btn {
            width: 100%;
            background: #ef4444;
            border: none;
            color: #fff;
            font-size: 0.8rem;
            padding: 0.6rem 0.9rem;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: 0.18s background;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        .sidebar-version {
            font-size: 0.65rem;
            color: #64748b;
            text-align: center;
            margin-top: 0.65rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: fixed;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>

    <div class="sidebar-header">
        <h2>CMS Panel</h2>
    </div>

    <div class="sidebar-content">
        <div class="menu-group-title">Contenido</div>

        <a href="{{ route('about-me.index') }}" class="menu-item {{ request()->routeIs('about-me.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            About Me
        </a>

        <a href="{{ route('projects.index') }}" class="menu-item {{ request()->routeIs('projects.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
            Projects
        </a>

        <a href="{{ route('tools.index') }}" class="menu-item {{ request()->routeIs('tools.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="m14.7 6.3 3 3L9 18H6v-3L14.7 6.3z"/><path d="M13.2 2.3 15 4l-2 2-1.8-1.7"/><path d="M17 18v4"/><path d="M19 20h-4"/></svg>
            Tools
        </a>

        <a href="{{ route('certificates.index') }}" class="menu-item {{ request()->routeIs('certificates.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 15l-3.5 2 1-4-3-2.9 4-.3L12 6l1.5 3.8 4 .3-3 2.9 1 4z"/><path d="M19 21l-2-2.5L15 21l-1-4"/></svg>
            Certificates
        </a>

        <a href="{{ route('careers.index') }}" class="menu-item {{ request()->routeIs('careers.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z"/><path d="M16 3v4"/><path d="M8 3v4"/><path d="M12 11h0"/><path d="M12 15h0"/></svg>
            Career
        </a>
    </div>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                Logout
            </button>
        </form>
        <div class="sidebar-version">v1.0.0</div>
    </div>
</div>