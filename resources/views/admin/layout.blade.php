<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin')</title>
    <style>
        :root { --ink: #101828; --muted: #667085; --line: #d0d5dd; --panel: #fff; --green: #007a3d; --deep: #063d2a; --blue: #005eb8; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Inter, ui-sans-serif, system-ui, sans-serif; background: #f6f8fb; color: var(--ink); }
        a { color: inherit; font-weight: 800; text-decoration: none; }
        .admin-shell { min-height: 100vh; display: grid; grid-template-columns: 280px minmax(0, 1fr); }
        .sidebar { padding: 22px 18px; background: linear-gradient(180deg, var(--deep), #092f52); color: #fff; position: sticky; top: 0; height: 100vh; }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 26px; font-weight: 950; }
        .brand-mark { width: 42px; height: 42px; display: grid; place-items: center; border-radius: 50%; background: linear-gradient(135deg, var(--green), var(--blue)); box-shadow: 0 12px 22px rgba(0,0,0,.2); }
        nav { display: grid; gap: 9px; }
        .nav-button { display: flex; align-items: center; justify-content: space-between; gap: 10px; min-height: 44px; border: 1px solid rgba(255,255,255,.14); border-radius: 8px; padding: 11px 13px; color: rgba(255,255,255,.82); background: rgba(255,255,255,.07); transition: background .16s ease, transform .16s ease, color .16s ease; }
        .nav-button:hover, .nav-button.active { color: #fff; background: rgba(255,255,255,.18); transform: translateX(2px); }
        .site-link { margin-top: 18px; color: #101828; background: #ffb703; border-color: transparent; }
        .logout-form { margin-top: 9px; }
        .logout-button { width: 100%; text-align: left; background: rgba(214, 40, 57, .92); }
        .content { min-width: 0; }
        header { min-height: 76px; display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 0 28px; background: #fff; border-bottom: 1px solid var(--line); box-shadow: 0 12px 30px rgba(16,24,40,.05); }
        .page-kicker { margin: 0 0 4px; color: var(--muted); font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: .08em; }
        h1 { margin: 0; font-size: 26px; }
        main { width: 100%; margin: 26px auto; padding: 0 24px; }
        .panel { background: var(--panel); border: 1px solid var(--line); border-radius: 8px; padding: 20px; margin-bottom: 18px; box-shadow: 0 18px 36px rgba(16,24,40,.06); overflow-x: auto; }
        .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 18px; }
        .stat { background: #fff; border: 1px solid var(--line); border-radius: 8px; padding: 18px; box-shadow: 0 14px 28px rgba(16,24,40,.05); }
        .stat b { display: block; margin-top: 8px; font-size: 34px; line-height: 1; color: var(--green); }
        label { display: block; font-weight: 800; margin-bottom: 6px; font-size: 13px; }
        input, select, textarea { width: 100%; border: 1px solid var(--line); border-radius: 6px; padding: 11px; margin-bottom: 12px; outline: none; }
        input:focus, select:focus, textarea:focus { border-color: var(--green); box-shadow: 0 0 0 4px rgba(0, 122, 61, .12); }
        button { border: 0; border-radius: 6px; background: linear-gradient(135deg, var(--green), var(--blue)); color: #fff; padding: 11px 14px; font-weight: 900; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid var(--line); padding: 12px; text-align: left; font-size: 14px; }
        th { color: var(--muted); font-size: 12px; text-transform: uppercase; }
        tr:hover td { background: #f9fafb; }
        .ok { color: var(--green); font-weight: 800; }
        .filters { display: grid; grid-template-columns: repeat(4, 1fr) auto; gap: 10px; align-items: end; }
        .filters.compact { grid-template-columns: repeat(3, 1fr) auto; }
        .split { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .inline { display: flex; align-items: center; gap: 8px; }
        .inline input { width: auto; margin: 0; }
        .table-wrap { width: 100%; overflow-x: auto; }
        .muted { color: var(--muted); }
        .pill { display: inline-block; border-radius: 999px; padding: 5px 9px; background: #eef4f7; font-weight: 900; font-size: 12px; }
        @media (max-width: 900px) {
            .admin-shell { grid-template-columns: 1fr; }
            .sidebar { position: static; height: auto; }
            nav { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .grid, .filters, .filters.compact, .split { grid-template-columns: 1fr; }
            header { height: auto; padding: 18px; align-items: flex-start; flex-direction: column; }
        }
        @media (max-width: 560px) { nav { grid-template-columns: 1fr; } main { padding: 0 14px; } }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="sidebar">
            <div class="brand"><span class="brand-mark">26</span><span>World Cup Badge Admin</span></div>
            <nav>
                <a class="nav-button {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard <span>&gt;</span></a>
                <a class="nav-button {{ request()->routeIs('admin.countries') ? 'active' : '' }}" href="{{ route('admin.countries') }}">Countries <span>&gt;</span></a>
                <a class="nav-button {{ request()->routeIs('admin.years') ? 'active' : '' }}" href="{{ route('admin.years') }}">Years <span>&gt;</span></a>
                <a class="nav-button {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">Settings <span>&gt;</span></a>
                <a class="nav-button {{ request()->routeIs('admin.records') ? 'active' : '' }}" href="{{ route('admin.records') }}">Records <span>&gt;</span></a>
                <a class="nav-button {{ request()->routeIs('admin.visitor-logs') ? 'active' : '' }}" href="{{ route('admin.visitor-logs') }}">Visitor Logs <span>&gt;</span></a>
                <a class="nav-button site-link" href="{{ route('home') }}">View Site <span>+</span></a>
                <form class="logout-form" method="post" action="{{ route('admin.logout') }}">@csrf<button class="logout-button" type="submit">Logout</button></form>
            </nav>
        </aside>
        <div class="content">
            <header>
                <div>
                    <p class="page-kicker">Admin Panel</p>
                    <h1>@yield('title', 'Admin')</h1>
                </div>
            </header>
            <main>
                @if (session('status')) <p class="ok">{{ session('status') }}</p> @endif
                @if ($errors->any()) <div class="panel">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div> @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
