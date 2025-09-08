<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Panel' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
    <style>
        body { margin:0; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Fira Sans', 'Droid Sans', 'Helvetica Neue', Arial, sans-serif; background:#0f172a; color:#FFFFFF ; }
        .layout-wrapper { display:flex; min-height:100vh; }
        .main-content { flex:1; padding:1.25rem 1.5rem; }
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
        @include('sidebar')
        <div class="main-content">
            @yield('content')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>
</html>
