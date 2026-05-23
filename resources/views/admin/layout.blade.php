<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin')</title>
    <style>
        body { margin: 0; font-family: Inter, ui-sans-serif, system-ui, sans-serif; background: #f5f8fb; color: #14213d; }
        header { height: 58px; display: flex; align-items: center; justify-content: space-between; padding: 0 24px; background: #fff; border-bottom: 1px solid #d9e2ec; }
        nav { display: flex; gap: 12px; flex-wrap: wrap; }
        a { color: #167c54; font-weight: 800; text-decoration: none; }
        main { width: min(1120px, 94vw); margin: 24px auto; }
        .panel { background: #fff; border: 1px solid #d9e2ec; border-radius: 8px; padding: 18px; margin-bottom: 18px; }
        .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
        .stat { background: #fff; border: 1px solid #d9e2ec; border-radius: 8px; padding: 16px; }
        .stat b { display: block; font-size: 28px; }
        label { display: block; font-weight: 800; margin-bottom: 6px; font-size: 13px; }
        input, select, textarea { width: 100%; border: 1px solid #d9e2ec; border-radius: 6px; padding: 10px; margin-bottom: 12px; }
        button { border: 0; border-radius: 6px; background: #167c54; color: #fff; padding: 11px 14px; font-weight: 900; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid #d9e2ec; padding: 11px; text-align: left; font-size: 14px; }
        th { color: #607087; font-size: 12px; text-transform: uppercase; }
        .ok { color: #167c54; font-weight: 800; }
        .filters { display: grid; grid-template-columns: repeat(4, 1fr) auto; gap: 10px; align-items: end; }
        .inline { display: flex; align-items: center; gap: 8px; }
        .inline input { width: auto; margin: 0; }
        @media (max-width: 800px) { .grid, .filters { grid-template-columns: 1fr; } header { height: auto; padding: 14px; align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
    <header>
        <strong>World Cup Badge Admin</strong>
        <nav>
            <a href="{{ route('home') }}">Site</a>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.countries') }}">Countries</a>
            <a href="{{ route('admin.years') }}">Years</a>
            <a href="{{ route('admin.settings') }}">Settings</a>
            <a href="{{ route('admin.records') }}">Records</a>
            <form method="post" action="{{ route('admin.logout') }}">@csrf<button type="submit">Logout</button></form>
        </nav>
    </header>
    <main>
        @if (session('status')) <p class="ok">{{ session('status') }}</p> @endif
        @if ($errors->any()) <div class="panel">@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div> @endif
        @yield('content')
    </main>
</body>
</html>
