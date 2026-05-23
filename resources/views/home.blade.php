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
            --ink: #14213d;
            --muted: #607087;
            --line: #d9e2ec;
            --panel: #ffffff;
            --grass: #167c54;
            --gold: #f2b705;
            --red: #d7263d;
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
            background: linear-gradient(180deg, #f7fbff 0%, #eef4f8 100%);
        }

        a {
            color: inherit;
        }

        .topbar {
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 0 5vw;
            background: #fff;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            font-weight: 800;
        }

        .nav {
            display: flex;
            gap: 14px;
            color: var(--muted);
            font-size: 14px;
        }

        .hero {
            padding: 32px 5vw 18px;
            background: linear-gradient(135deg, #f8fcff 0%, #f2fff8 100%);
            border-bottom: 1px solid var(--line);
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(32px, 5vw, 58px);
            line-height: 1;
            letter-spacing: 0;
            max-width: 920px;
        }

        .hero p {
            max-width: 780px;
            color: var(--muted);
            font-size: 18px;
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
            box-shadow: 0 18px 34px rgba(20, 33, 61, .08);
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
            background: var(--grass);
            color: #fff;
            box-shadow: 0 10px 18px rgba(22, 124, 84, .18);
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
                radial-gradient(circle at 50% 50%, rgba(22, 124, 84, .10), transparent 34%),
                linear-gradient(135deg, #ffffff 0%, #f4f9fb 100%);
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
        <div class="brand">{{ $settings['website_name'] ?? 'World Cup 2026 Badge Maker' }}</div>
        <nav class="nav"><a href="{{ route('country-ranking') }}">Ranking</a><a
                href="{{ route('admin.login') }}">Admin</a></nav>
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
                <p class="note">If download has a problem, copy the link and try in Google Chrome or Firefox.</p>
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
                    const placeholder = document.getElementById('photoPlaceholder');
                    placeholder.hidden = true;
                    placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            });
            const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
            const setPhotoControls = (x, y, zoom) => {
                photoState = {
                    x: Math.round(clamp(x, -80, 80)),
                    y: Math.round(clamp(y, -80, 80)),
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
            ['pointerup', 'pointercancel', 'pointerleave'].forEach(eventName => {
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
