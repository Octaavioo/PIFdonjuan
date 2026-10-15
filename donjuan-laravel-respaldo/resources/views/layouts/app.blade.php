<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Gestión de Inventario') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="app-layout">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-row">
                <div class="brand-logo">DJ</div>
                <div class="brand-copy">
                    <div class="brand-title">Don Juan</div>
                    <div class="brand-subtitle">Gestión de Inventario</div>
                </div>
            </div>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-title">Menú principal</div>

            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">⌂</span><span>Inicio</span>
            </a>

            <a href="{{ route('productos.index') }}"
               class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                <span class="nav-icon">◇</span><span>Productos</span>
            </a>

            <a href="{{ route('bodegas.index') }}"
               class="nav-link {{ request()->routeIs('bodegas.*') ? 'active' : '' }}">
                <span class="nav-icon">⌂</span><span>Bodegas</span>
            </a>

            <a href="{{ route('responsables.index') }}"
               class="nav-link {{ request()->routeIs('responsables.*') ? 'active' : '' }}">
                <span class="nav-icon">♟</span><span>Responsables</span>
            </a>

            <a href="{{ route('movimientos.index') }}"
               class="nav-link {{ request()->routeIs('movimientos.index') || request()->routeIs('movimientos.create') ? 'active' : '' }}">
                <span class="nav-icon">⇄</span><span>Movimientos</span>
            </a>

            <a href="{{ route('movimientos.historial') }}"
               class="nav-link {{ request()->routeIs('movimientos.historial') ? 'active' : '' }}">
                <span class="nav-icon">▤</span><span>Historial</span>
            </a>
        </div>

        <div class="sidebar-bottom">
            <div class="sidebar-title">Mi cuenta</div>

            <a href="#" class="nav-link">
                <span class="nav-icon">♟</span><span>Perfil</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link"
                        style="width:100%;border:0;background:transparent;cursor:pointer;text-align:left;">
                    <span class="nav-icon">↪</span><span>Cerrar sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="main-area">
        <header class="topbar">
            <div>
                <div class="topbar-title">Gestión de Inventario</div>
                <div class="topbar-subtitle">Legumbres y Frutos Secos Don Juan</div>
            </div>

            <div style="display:flex;align-items:center;gap:16px;">
                <div class="theme-toggle">
                    <button type="button" class="theme-button" data-theme-dark onclick="toggleTheme()">☾</button>
                    <button type="button" class="theme-button" data-theme-light onclick="toggleTheme()">☀</button>
                </div>

                <div style="border-left:1px solid #263241;padding-left:18px;color:#cbd5e1;font-size:13px;">
                    {{ auth()->user()?->name ?? 'Administrador' }}
                </div>
            </div>
        </header>

        <main class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
