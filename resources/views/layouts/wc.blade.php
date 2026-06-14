<!doctype html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'World Cup 2026')</title>
    <meta property="og:image" content="{{ url('images/wc2026-mascot.jpg') }}">
    <meta property="og:image:width" content="696">
    <meta property="og:image:height" content="464">
    @yield('meta')
    <style>
        :root {
            --ink:   #101828;
            --muted: #667085;
            --line:  #d0d5dd;
            --green: #007a3d;
            --deep:  #063d2a;
            --blue:  #005eb8;
            --gold:  #ffb703;
            --red:   #d62839;
            --panel: #ffffff;
            --g: clamp(14px, 3vw, 48px);
        }
        * { box-sizing: border-box; }
        [hidden] { display: none !important; }
        body {
            margin: 0;
            color: var(--ink);
            background:
                linear-gradient(180deg, rgba(255,255,255,.92), rgba(246,248,251,.98)),
                repeating-linear-gradient(90deg, rgba(0,122,61,.05) 0 72px, rgba(0,94,184,.04) 72px 144px);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, sans-serif;
            overflow-x: hidden;
        }
        a { color: inherit; text-decoration: none; }

        /* ── Topbar ── */
        .topbar {
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 0 var(--g);
            background: rgba(255,255,255,.96);
            border-bottom: 1px solid var(--line);
            box-shadow: 0 8px 24px rgba(16,24,40,.06);
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(14px);
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 950;
            font-size: 15px;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .brand-mark {
            width: 36px; height: 36px;
            display: grid; place-items: center;
            border-radius: 50%;
            color: #fff;
            font-size: 14px;
            font-weight: 950;
            background: linear-gradient(135deg, var(--green), var(--blue));
        }
        .nav {
            display: flex;
            gap: 7px;
            align-items: center;
            flex-wrap: wrap;
            font-size: 13px;
        }
        .nav a {
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 7px 14px;
            font-weight: 900;
            background: #fff;
            white-space: nowrap;
            transition: all .15s;
        }
        .nav a:hover { border-color: var(--green); color: var(--green); }
        .nav a.active {
            background: linear-gradient(135deg, var(--deep), var(--blue));
            color: #fff;
            border-color: transparent;
        }

        /* ── Hero ── */
        .hero {
            padding: 36px var(--g) 30px;
            color: #fff;
            background:
                linear-gradient(90deg, rgba(6,61,42,.97), rgba(0,94,184,.85)),
                radial-gradient(circle at 82% 22%, rgba(255,183,3,.4), transparent 28%),
                linear-gradient(135deg, #063d2a, #005eb8);
            overflow: hidden;
            position: relative;
        }
        .hero::after {
            content: "";
            position: absolute;
            right: var(--g);
            bottom: -68px;
            width: min(360px, 54vw);
            aspect-ratio: 1;
            border: 16px solid rgba(255,255,255,.12);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-inner { position: relative; z-index: 1; }
        .eyebrow {
            margin: 0 0 8px;
            color: var(--gold);
            font-size: 12px;
            font-weight: 950;
            letter-spacing: .1em;
            text-transform: uppercase;
        }
        .hero h1 {
            margin: 0;
            font-size: clamp(30px, 4.5vw, 58px);
            line-height: .97;
            max-width: 900px;
        }
        .hero-copy {
            max-width: 780px;
            margin: 12px 0 0;
            color: rgba(255,255,255,.82);
            font-size: clamp(14px, 1.3vw, 17px);
            line-height: 1.5;
        }

        /* ── Common panel ── */
        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 16px 32px rgba(16,24,40,.06);
        }
        .panel h2 { margin: 0 0 10px; font-size: 20px; }
        .muted { color: var(--muted); line-height: 1.5; font-size: 14px; }
        .section { margin-bottom: 32px; }
        .section-header { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 16px; }
        .section-header h2 { margin: 0; font-size: 22px; }

        /* ── Footer ── */
        footer {
            padding: 18px var(--g);
            color: var(--muted);
            background: #fff;
            border-top: 1px solid var(--line);
            font-size: 13px;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: .35; transform: scale(.78); }
        }

        @media (max-width: 760px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
                padding-top: 12px;
                padding-bottom: 12px;
            }
            .nav { width: 100%; gap: 6px; }
            .nav a {
                flex: 1 1 calc(33% - 6px);
                text-align: center;
                padding: 8px 6px;
                font-size: 12px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

<header class="topbar">
    <div class="brand">
        <span class="brand-mark">26</span>
        World Cup 2026
    </div>
    <nav class="nav">
        <a href="{{ route('home') }}"            @class(['active' => request()->routeIs('home')])>Badge</a>
        <a href="{{ route('today-match') }}"     @class(['active' => request()->routeIs('today-match')])>Today</a>
        <a href="{{ route('fixtures') }}"        @class(['active' => request()->routeIs('fixtures')])>Fixtures</a>
        <a href="{{ route('standings') }}"       @class(['active' => request()->routeIs('standings')])>Standings</a>
        <a href="{{ route('country-ranking') }}" @class(['active' => request()->routeIs('country-ranking')])>Ranking</a>
    </nav>
</header>

@yield('hero')

<main style="width:100%;max-width:1400px;margin:0 auto;padding:28px var(--g) 52px">
    @yield('content')
</main>

<footer>World Cup 2026 — All times in Bangladesh Standard Time (BDT, UTC+6)</footer>

@yield('scripts')
</body>
</html>
