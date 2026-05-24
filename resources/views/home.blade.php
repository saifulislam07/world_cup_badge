<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="{{ $settings['meta_description'] ?? 'Create a custom football supporter placard.' }}">
    <meta property="og:title" content="{{ $settings['meta_title'] ?? 'World Cup 2026 Supporter Badge Generator' }}">
    <title>{{ $settings['meta_title'] ?? 'World Cup 2026 Supporter Badge Generator' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js" defer></script>
    <style>
        :root {
            --ink: #101828;
            --muted: #667085;
            --line: #d0d5dd;
            --panel: #ffffff;
            --grass: #007a3d;
            --deep: #063d2a;
            --gold: #ffb703;
            --red: #d62839;
            --blue: #005eb8;
        }

        * {
            box-sizing: border-box;
        }

        [hidden] {
            display: none !important;
        }

        body {
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, sans-serif;
            color: var(--ink);
            background:
                linear-gradient(180deg, rgba(255, 255, 255, .88), rgba(247, 250, 252, .96)),
                repeating-linear-gradient(90deg, rgba(0, 122, 61, .06) 0 70px, rgba(0, 94, 184, .04) 70px 140px);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .topbar {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 0 5vw;
            background: rgba(255, 255, 255, .92);
            border-bottom: 1px solid rgba(208, 213, 221, .9);
            box-shadow: 0 12px 30px rgba(16, 24, 40, .06);
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
            letter-spacing: 0;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #fff;
            background: linear-gradient(135deg, var(--grass), var(--blue));
            box-shadow: 0 10px 22px rgba(0, 122, 61, .22);
        }

        .nav {
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 14px;
        }

        .nav a {
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 10px 15px;
            font-weight: 900;
            color: var(--ink);
            background: #fff;
            transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
        }

        .nav a:hover {
            transform: translateY(-1px);
            border-color: rgba(0, 122, 61, .35);
            box-shadow: 0 10px 20px rgba(16, 24, 40, .08);
        }

        .nav .admin-link {
            color: #fff;
            border-color: transparent;
            background: linear-gradient(135deg, var(--deep), var(--grass));
            box-shadow: 0 12px 24px rgba(0, 122, 61, .2);
        }

        .hero {
            min-height: 248px;
            padding: 34px 5vw 28px;
            display: grid;
            align-items: end;
            background:
                linear-gradient(90deg, rgba(6, 61, 42, .96), rgba(0, 94, 184, .80)),
                radial-gradient(circle at 82% 25%, rgba(255, 183, 3, .42), transparent 28%),
                linear-gradient(135deg, #063d2a, #005eb8);
            color: #fff;
            overflow: hidden;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto 5vw -52px auto;
            width: min(360px, 52vw);
            aspect-ratio: 1;
            border: 18px solid rgba(255, 255, 255, .16);
            border-radius: 50%;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--gold);
            font-size: 13px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(34px, 5vw, 62px);
            line-height: 1;
            letter-spacing: 0;
            max-width: 920px;
            position: relative;
            z-index: 1;
        }

        .hero p {
            max-width: 780px;
            color: rgba(255, 255, 255, .82);
            font-size: 18px;
            position: relative;
            z-index: 1;
        }

        .workspace {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 24px;
            padding: 26px 5vw 34px;
            align-items: stretch;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 22px;
            box-shadow: 0 20px 40px rgba(16, 24, 40, .08);
        }

        .details-panel {
            grid-column: span 3;
            min-height: 430px;
        }

        .panel h2 {
            margin: 0 0 16px;
            font-size: 20px;
        }

        label {
            display: block;
            font-weight: 700;
            font-size: 13px;
            margin-bottom: 7px;
        }

        input,
        select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 12px 13px;
            background: #fff;
            color: var(--ink);
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: var(--grass);
            box-shadow: 0 0 0 4px rgba(0, 122, 61, .12);
        }

        input[type="color"] {
            height: 44px;
            padding: 4px;
        }

        .field {
            margin-bottom: 14px;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .details-panel .row {
            grid-template-columns: 1fr;
        }

        .check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 6px 0 16px;
        }

        .check input {
            width: 18px;
            height: 18px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            border: 0;
            border-radius: 6px;
            padding: 13px 16px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .16s ease, box-shadow .16s ease, background .16s ease;
        }

        button:hover {
            transform: translateY(-1px);
        }

        .primary {
            background: linear-gradient(135deg, var(--grass), var(--blue));
            color: #fff;
            box-shadow: 0 14px 26px rgba(0, 122, 61, .22);
        }

        .ghost {
            background: #eaf1f7;
            color: var(--ink);
        }

        .note {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.45;
        }

        .preview-note {
            max-width: 390px;
            margin: -4px 0 0;
            text-align: center;
        }

        .preview-wrap {
            grid-column: span 6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 18px;
            min-height: 430px;
            overflow: hidden;
            background:
                linear-gradient(rgba(255, 255, 255, .86), rgba(255, 255, 255, .92)),
                repeating-linear-gradient(90deg, rgba(0, 122, 61, .12) 0 46px, rgba(0, 94, 184, .08) 46px 92px);
            border-color: #cfe0ea;
        }

        .side-ranking {
            grid-column: span 3;
            min-height: 430px;
            overflow: hidden;
        }

        .placard {
            --flag-primary: #00ff62;
            --flag-shadow: rgba(0, 255, 98, .35);
            width: min(100%, 390px);
            aspect-ratio: 1 / 1;
            position: relative;
            background: transparent;
            overflow: hidden;
            box-shadow: none;
        }

        .badge-circle {
            position: absolute;
            inset: 18px;
            border: 10px solid var(--flag-primary);
            border-radius: 50%;
            overflow: hidden;
            background: #111b25;
            cursor: grab;
            touch-action: none;
            user-select: none;
        }

        .badge-circle:active {
            cursor: grabbing;
        }

        .badge-circle::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, .08), transparent 36%), radial-gradient(circle at 50% 50%, transparent 0 48%, rgba(0, 0, 0, .45) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .badge-circle::after {
            content: "";
            position: absolute;
            inset: 0;
            background: none;
            z-index: 3;
            pointer-events: none;
        }

        .main-photo {
            position: absolute;
            left: 50%;
            top: 50%;
            width: auto;
            height: 88%;
            max-width: none;
            max-height: none;
            border-radius: 0;
            object-fit: initial;
            object-position: center;
            z-index: 1;
            border: 0;
            box-shadow: none;
            transform-origin: center;
            transform: translate(-50%, -50%) scale(1);
            pointer-events: none;
            user-select: none;
            -webkit-user-drag: none;
        }

        .photo-placeholder {
            position: absolute;
            inset: 0;
            width: auto;
            height: auto;
            translate: none;
            border-radius: 0;
            display: grid;
            place-items: center;
            color: #8fa1b4;
            font-size: 18px;
            font-weight: 950;
            z-index: 1;
            background: #1d2a36;
            border: 0;
        }

        .crest-box {
            position: absolute;
            left: 28px;
            top: 50%;
            width: 106px;
            z-index: 5;
            text-align: center;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .crest-box img {
            width: 68px;
            height: 46px;
            object-fit: contain;
            margin: 0 auto;
            padding: 0;
            border-radius: 3px;
            background: transparent;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, .5));
        }

        .country-name {
            display: none;
        }

        .year-label {
            position: absolute;
            right: 40px;
            top: 50%;
            z-index: 6;
            color: var(--flag-primary);
            font-size: 22px;
            line-height: 1;
            font-weight: 950;
            transform: translateY(-50%);
            -webkit-text-stroke: .45px rgba(255, 255, 255, .72);
            paint-order: stroke fill;
            text-shadow: 0 2px 0 rgba(0, 0, 0, .72), 0 0 10px var(--flag-shadow), 0 5px 9px rgba(0, 0, 0, .72);
            pointer-events: none;
        }

        .bottom-country-name {
            position: absolute;
            left: 48px;
            right: 48px;
            bottom: 66px;
            z-index: 7;
            color: var(--flag-primary);
            font-size: 34px;
            line-height: .95;
            text-align: center;
            font-weight: 950;
            -webkit-text-stroke: .6px rgba(255, 255, 255, .72);
            paint-order: stroke fill;
            text-shadow: 0 3px 0 rgba(0, 0, 0, .72), 0 0 14px var(--flag-shadow), 0 6px 10px rgba(0, 0, 0, .86);
            pointer-events: none;
        }

        .footer-mark {
            display: none;
        }

        .stat-cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            padding: 0 5vw 28px;
        }

        .stat-card {
            min-height: 132px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            box-shadow: 0 12px 28px rgba(20, 33, 61, .06);
        }

        .stat-card h2 {
            margin: 0 0 12px;
            color: var(--muted);
            font-size: 13px;
            text-transform: uppercase;
        }

        .stat-value {
            font-size: 42px;
            line-height: 1;
            font-weight: 950;
        }

        .flag-count-list {
            display: grid;
            gap: 12px;
            max-height: 300px;
            overflow: hidden;
        }

        .flag-count {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 8px 0;
            font-weight: 800;
            border-bottom: 1px solid #edf3f7;
        }

        .flag-count:last-child {
            border-bottom: 0;
        }

        .flag-country {
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .flag-country span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .ranking {
            padding: 0 5vw 36px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid var(--line);
            text-align: left;
        }

        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
        }

        .mini-flag {
            width: 34px;
            height: 23px;
            object-fit: cover;
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
            border: 1px solid var(--line);
            border-radius: 2px;
        }

        .status {
            min-height: 20px;
            color: var(--grass);
            font-size: 13px;
            font-weight: 700;
        }

        footer {
            padding: 20px 5vw;
            color: var(--muted);
            background: #fff;
            border-top: 1px solid var(--line);
        }

        @media (max-width: 900px) {
            .workspace {
                grid-template-columns: 1fr;
            }

            .details-panel,
            .preview-wrap,
            .side-ranking {
                grid-column: auto;
            }

            .stat-cards {
                grid-template-columns: 1fr;
            }

            .preview-wrap {
                min-height: auto;
                order: -1;
            }
        }

        @media (max-width: 560px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .nav {
                width: 100%;
            }

            .nav a {
                flex: 1;
                text-align: center;
            }

            .row {
                grid-template-columns: 1fr;
            }

            .placard {
                width: 100%;
            }

            .preview-wrap {
                min-height: auto;
                padding: 10px;
            }

            .badge-circle {
                inset: 12px;
                border-width: 8px;
            }

            .crest-box {
                left: 14px;
                top: 50%;
                width: 86px;
                transform: translateY(-50%);
            }

            .crest-box img {
                width: 54px;
                height: 36px;
                padding: 0;
                margin-bottom: 6px;
            }

            .year-label {
                right: 22px;
                top: 50%;
                font-size: 17px;
                transform: translateY(-50%);
            }

            .bottom-country-name {
                left: 32px;
                right: 32px;
                bottom: 48px;
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <header class="topbar">
        <div class="brand"><span
                class="brand-mark">26</span>{{ $settings['website_name'] ?? 'World Cup 2026 Badge Maker' }}</div>
        <nav class="nav">
            <a href="{{ route('today-match') }}">Today's Match</a>
            <a href="{{ route('country-ranking') }}">Ranking</a>
            {{-- <a class="admin-link"
                href="{{ route('admin.login') }}">Admin</a> --}}
        </nav>
    </header>

    <main class="workspace">
        <section class="panel details-panel">
            <h2>Badge Details</h2>
            <form id="badgeForm">
                @csrf
                <div class="field">
                    <label for="country">Country</label>
                    <select id="country" name="country_id" required>
                        <option value="" selected disabled>Select country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" data-name="{{ $country->name }}"
                                data-code="{{ $country->code }}" data-flag="{{ $country->flag }}">
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="world_cup_year_id" value="{{ $defaultYear?->id }}">
                <div class="row">
                    <div class="field"><label for="photo">Photo</label><input id="photo" name="photo"
                            type="file" accept="image/png,image/jpeg,image/webp" required></div>
                </div>
                <div class="actions">
                </div>
                <p class="note " style="color: red">যদি ডাউনলোডে সমস্যা হয়, তাহলে লিংকটি কপি করে Google Chrome অথবা
                    Firefox
                    ব্রাউজারে
                    খুলে আবার চেষ্টা করুন।</p>

                <p class="status" id="status"></p>
            </form>
        </section>

        <section class="panel preview-wrap">
            <article class="placard" id="placard">
                <div class="badge-circle" id="badgeCircle">
                    <div class="photo-placeholder" id="photoPlaceholder">UPLOAD PHOTO</div>
                    <img class="main-photo" id="mainPhoto" alt="" hidden>
                </div>
                <div class="crest-box"><img id="flagImage" crossorigin="anonymous" alt="" hidden>
                </div>
                <div class="year-label" hidden>2026</div>
                <div class="bottom-country-name" id="bottomCountryName"></div>
                <div class="footer-mark">Made for football fans</div>
            </article>
            <p class="note preview-note">ছবিটি circle-এর ভিতরে drag করে নিজের মতো position ঠিক করতে পারবেন। zoom করতে mouse wheel বা pinch ব্যবহার করুন।</p>
            <button type="button" class="primary" id="downloadBtn">Download PNG</button>
        </section>

        <section class="panel side-ranking">
            <h2>Flag & Count</h2>
            <div class="flag-count-list" id="flagCountList">
                @forelse ($ranking as $row)
                    <div class="flag-count">
                        <div class="flag-country">
                            @if ($row->country?->flag)
                                <img class="mini-flag" src="{{ $row->country->flag }}" alt="">
                            @endif
                            <span>{{ $row->country?->name ?? 'Unknown' }}</span>
                        </div>
                        <span>{{ $row->total }}</span>
                    </div>
                @empty
                    <p class="note">No downloads yet.</p>
                @endforelse
            </div>
        </section>
    </main>



    <footer>{{ $settings['footer_text'] ?? 'Privacy friendly: your uploaded photo is only used in your browser.' }}
    </footer>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('badgeForm');
            const country = document.getElementById('country');
            const photo = document.getElementById('photo');
            const status = document.getElementById('status');
            const badgeCircle = document.getElementById('badgeCircle');
            const mainPhoto = document.getElementById('mainPhoto');
            const flagImage = document.getElementById('flagImage');
            const bottomCountryName = document.getElementById('bottomCountryName');
            const yearLabel = document.querySelector('.year-label');
            const flagCountList = document.getElementById('flagCountList');
            const pointers = new Map();
            let dragStart = null;
            let pinchStart = null;
            let photoState = {
                x: 0,
                y: 0,
                zoom: 100
            };
            mainPhoto.draggable = false;
            badgeCircle.addEventListener('dragstart', (event) => event.preventDefault());
            const flagColors = {
                ar: '#75aadb',
                au: '#0057b8',
                at: '#ed2939',
                ba: '#002f6c',
                be: '#fae042',
                br: '#009b3a',
                ca: '#ff0000',
                ch: '#ff0000',
                ci: '#009e60',
                co: '#fcd116',
                cw: '#002b7f',
                cz: '#d7141a',
                de: '#ffce00',
                dz: '#006233',
                ec: '#ffdd00',
                eg: '#ce1126',
                es: '#c60b1e',
                fr: '#0055a4',
                'gb-eng': '#cf142b',
                'gb-sct': '#005eb8',
                gh: '#fcd116',
                hr: '#f00000',
                ht: '#00209f',
                iq: '#ce1126',
                ir: '#239f40',
                jo: '#007a3d',
                jp: '#bc002d',
                kr: '#c60c30',
                ma: '#c1272d',
                mx: '#006847',
                nl: '#ae1c28',
                no: '#ba0c2f',
                nz: '#00247d',
                pa: '#005293',
                pt: '#006600',
                py: '#d52b1e',
                qa: '#8a1538',
                sa: '#006c35',
                se: '#006aa7',
                sn: '#00853f',
                tn: '#e70013',
                tr: '#e30a17',
                us: '#b31942',
                uy: '#0038a8',
                uz: '#0099b5',
                za: '#007a4d',
                cv: '#003893',
                cd: '#007fff'
            };
            const hexToRgb = (hex) => {
                const clean = hex.replace('#', '');
                return [
                    parseInt(clean.slice(0, 2), 16),
                    parseInt(clean.slice(2, 4), 16),
                    parseInt(clean.slice(4, 6), 16)
                ];
            };
            const renderRanking = (ranking) => {
                if (!Array.isArray(ranking) || !flagCountList) return;
                flagCountList.replaceChildren();
                if (!ranking.length) {
                    const empty = document.createElement('p');
                    empty.className = 'note';
                    empty.textContent = 'No downloads yet.';
                    flagCountList.append(empty);
                    return;
                }
                ranking.forEach((row) => {
                    const item = document.createElement('div');
                    item.className = 'flag-count';
                    const countryWrap = document.createElement('div');
                    countryWrap.className = 'flag-country';
                    if (row.flag) {
                        const img = document.createElement('img');
                        img.className = 'mini-flag';
                        img.src = row.flag;
                        img.alt = '';
                        countryWrap.append(img);
                    }
                    const name = document.createElement('span');
                    name.textContent = row.name || 'Unknown';
                    countryWrap.append(name);
                    const total = document.createElement('span');
                    total.textContent = row.total || 0;
                    item.append(countryWrap, total);
                    flagCountList.append(item);
                });
            };
            const updatePreview = () => {
                const selectedCountry = country.selectedOptions[0];
                const hasCountry = Boolean(selectedCountry?.value);
                const color = hasCountry ? (flagColors[selectedCountry?.dataset.code] || '#ffd21d') : '#7db7ee';
                const [r, g, b] = hexToRgb(color);
                const zoom = photoState.zoom / 100;
                const x = photoState.x;
                const y = photoState.y;
                document.getElementById('placard').style.setProperty('--flag-primary', color);
                document.getElementById('placard').style.setProperty('--flag-shadow',
                    `rgba(${r}, ${g}, ${b}, .38)`);
                mainPhoto.style.transform =
                    `translate(calc(-50% + ${x}px), calc(-50% + ${y}px)) scale(${zoom})`;
                bottomCountryName.textContent = hasCountry ? selectedCountry.dataset.name : '';
                flagImage.hidden = !hasCountry || !selectedCountry.dataset.flag;
                flagImage.src = hasCountry ? (selectedCountry.dataset.flag || '') : '';
                yearLabel.hidden = !hasCountry;
            };
            ['input', 'change'].forEach(eventName => form.addEventListener(eventName, updatePreview));
            photo.addEventListener('change', () => {
                const file = photo.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = () => {
                    const mainPhoto = document.getElementById('mainPhoto');
                    mainPhoto.src = reader.result;
                    mainPhoto.hidden = false;
                    setPhotoControls(0, 0, 100);
                    const placeholder = document.getElementById('photoPlaceholder');
                    placeholder.hidden = true;
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            });
            const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
            const setPhotoControls = (x, y, zoom) => {
                const dragLimit = Math.max(80, Math.round(badgeCircle.clientWidth * .38));
                photoState = {
                    x: Math.round(clamp(x, -dragLimit, dragLimit)),
                    y: Math.round(clamp(y, -dragLimit, dragLimit)),
                    zoom: Math.round(clamp(zoom, 100, 220)),
                };
                updatePreview();
            };
            const pointerDistance = () => {
                const points = [...pointers.values()];
                if (points.length < 2) return 0;
                return Math.hypot(points[0].clientX - points[1].clientX, points[0].clientY - points[1].clientY);
            };
            badgeCircle.addEventListener('pointerdown', (event) => {
                if (event.pointerType === 'mouse' && event.button !== 0) return;
                event.preventDefault();
                badgeCircle.setPointerCapture(event.pointerId);
                pointers.set(event.pointerId, event);
                if (pointers.size === 1) {
                    dragStart = {
                        clientX: event.clientX,
                        clientY: event.clientY,
                        x: photoState.x,
                        y: photoState.y,
                    };
                    pinchStart = null;
                } else if (pointers.size === 2) {
                    pinchStart = {
                        distance: pointerDistance(),
                        zoom: photoState.zoom,
                    };
                }
            });
            badgeCircle.addEventListener('pointermove', (event) => {
                if (!pointers.has(event.pointerId)) return;
                event.preventDefault();
                pointers.set(event.pointerId, event);
                if (pointers.size === 1 && dragStart) {
                    setPhotoControls(
                        dragStart.x + event.clientX - dragStart.clientX,
                        dragStart.y + event.clientY - dragStart.clientY,
                        photoState.zoom,
                    );
                } else if (pointers.size >= 2 && pinchStart) {
                    const distance = pointerDistance();
                    const nextZoom = pinchStart.zoom * (distance / Math.max(1, pinchStart.distance));
                    setPhotoControls(photoState.x, photoState.y, nextZoom);
                }
            });
            ['pointerup', 'pointercancel', 'lostpointercapture'].forEach(eventName => {
                badgeCircle.addEventListener(eventName, (event) => {
                    pointers.delete(event.pointerId);
                    if (pointers.size === 0) {
                        dragStart = null;
                        pinchStart = null;
                    }
                });
            });
            badgeCircle.addEventListener('wheel', (event) => {
                event.preventDefault();
                setPhotoControls(photoState.x, photoState.y, photoState.zoom + (event.deltaY < 0 ? 8 : -8));
            }, {
                passive: false
            });
            document.getElementById('downloadBtn').addEventListener('click', async () => {
                if (!form.reportValidity()) return;
                updatePreview();
                const placard = document.getElementById('placard');
                const placardRect = placard.getBoundingClientRect();
                const placardSize = Math.round(Math.min(placardRect.width, placardRect.height));
                const previousWidth = placard.style.width;
                const previousHeight = placard.style.height;
                let canvas;
                try {
                    placard.style.width = `${placardSize}px`;
                    placard.style.height = `${placardSize}px`;
                    canvas = await html2canvas(placard, {
                        scale: 2,
                        width: placardSize,
                        height: placardSize,
                        useCORS: true,
                        backgroundColor: null
                    });
                } finally {
                    placard.style.width = previousWidth;
                    placard.style.height = previousHeight;
                }
                const link = document.createElement('a');
                link.download = `world-cup-badge-${Date.now()}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
                const payload = new FormData(form);
                fetch('{{ route('download-count') }}', {
                        method: 'POST',
                        body: payload,
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        status.textContent = data.message || 'Download counted.';
                        renderRanking(data.ranking);
                    })
                    .catch(() => {
                        status.textContent = 'Downloaded. Count could not be updated.';
                    });
            });
            updatePreview();
        });
    </script>
</body>

</html>
