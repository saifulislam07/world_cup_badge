@extends('layouts.wc')

@section('title', 'সম্পূর্ণ ম্যাচ সূচি — World Cup 2026')

@section('meta')
<meta name="description" content="FIFA World Cup 2026 সম্পূর্ণ ম্যাচ সূচি — Bangladesh Standard Time (BDT) অনুযায়ী।">
<meta property="og:title" content="সম্পূর্ণ ম্যাচ সূচি — World Cup 2026">
@endsection

@section('styles')
<style>
    /* ── Toolbar ── */
    .toolbar {
        display: flex; align-items: center; justify-content: space-between;
        gap: 14px; margin-bottom: 14px; flex-wrap: wrap;
    }
    .toolbar h2 { margin: 0; font-size: 22px; }
    .btn-dl {
        border: 0; border-radius: 8px; padding: 11px 18px;
        color: #fff; font-weight: 900; font-size: 14px; font-family: inherit; cursor: pointer;
        background: linear-gradient(135deg, var(--green), var(--blue));
        box-shadow: 0 10px 22px rgba(0,122,61,.2);
        transition: opacity .15s;
        white-space: nowrap;
    }
    .btn-dl:hover { opacity: .9; }

    /* ── Filters ── */
    .filters {
        display: grid;
        grid-template-columns: minmax(180px,1fr) 190px 170px 155px auto auto;
        gap: 10px; margin-bottom: 12px;
    }
    .filters > * { min-width: 0; }
    .f-input, .f-select {
        width: 100%; border: 1px solid var(--line); border-radius: 8px;
        padding: 11px 12px; color: var(--ink); background: #fff;
        outline: none; font-family: inherit; font-size: 14px;
    }
    .f-input:focus, .f-select:focus { border-color: var(--green); box-shadow: 0 0 0 3px rgba(0,122,61,.1); }
    .toggle-label {
        display: flex; align-items: center; gap: 7px;
        border: 1px solid var(--line); border-radius: 8px; padding: 11px 13px;
        background: #fff; font-size: 13px; font-weight: 700; cursor: pointer;
        white-space: nowrap; transition: border-color .15s; user-select: none;
    }
    .toggle-label:hover { border-color: var(--green); }
    .toggle-label input { width:15px; height:15px; cursor:pointer; accent-color:var(--green); flex-shrink:0; }
    .btn-clear {
        border: 1px solid var(--line); border-radius: 8px; padding: 11px 14px;
        background: #fff; font-weight: 900; cursor: pointer; font-family: inherit;
        font-size: 14px; transition: all .15s; white-space: nowrap;
    }
    .btn-clear:hover { border-color: var(--red); color: var(--red); }
    .filter-info { margin: -4px 0 14px; color: var(--muted); font-size: 13px; font-weight: 700; }

    /* ── Poster ── */
    .poster {
        border-radius: 10px; padding: clamp(18px,2.8vw,36px);
        color: #fff; position: relative; overflow: hidden;
        background:
            linear-gradient(135deg, rgba(6,61,42,.97) 0%, rgba(0,94,184,.94) 62%, rgba(8,27,58,.98) 100%),
            repeating-linear-gradient(90deg, rgba(255,255,255,.07) 0 80px, transparent 80px 160px);
        box-shadow: 0 24px 56px rgba(16,24,40,.2);
    }
    .poster::before {
        content: ""; position: absolute; inset: 16px;
        border: 2px solid rgba(255,255,255,.14); border-radius: 8px; pointer-events: none;
    }
    .poster::after {
        content: ""; position: absolute;
        right: clamp(18px,5vw,80px); top: 28px;
        width: 220px; aspect-ratio: 1;
        border: 14px solid rgba(255,255,255,.07); border-radius: 50%; pointer-events: none;
    }
    .poster-head, .poster-dates, .poster-foot { position: relative; z-index: 1; }

    .poster-head {
        display: grid; grid-template-columns: minmax(0,1fr) auto;
        gap: 18px; align-items: end; margin-bottom: 22px;
    }
    .poster-kicker { margin:0 0 7px; color:var(--gold); font-size:12px; font-weight:950; letter-spacing:.1em; text-transform:uppercase; }
    .poster-title  { margin:0; font-size:clamp(28px,4vw,60px); line-height:.95; white-space:nowrap; color:#fff; }
    .poster-total  {
        min-width: 138px; border: 1px solid rgba(255,255,255,.2); border-radius: 8px;
        padding: 12px; text-align: right; background: rgba(255,255,255,.1);
    }
    .poster-total strong { display:block; font-size:30px; line-height:1; }
    .poster-total span   { font-size:12px; opacity:.8; }

    .poster-dates { display: grid; gap: 12px; }

    .date-group {
        display: grid; grid-template-columns: 168px minmax(0,1fr);
        gap: 12px; align-items: stretch;
    }
    .date-label {
        border-radius: 8px; padding: 13px; background: var(--gold);
        color: #101828; font-weight: 950;
    }
    .date-label strong { display:block; font-size:25px; line-height:1; }
    .date-label span   { display:block; margin-top:5px; font-size:12px; }

    .fixture-items { display: grid; gap: 8px; }
    .fixture-item {
        display: grid;
        grid-template-columns: 62px 86px minmax(200px,1fr) minmax(150px,.85fr);
        gap: 10px; align-items: center; min-height: 48px;
        border: 1px solid rgba(255,255,255,.13); border-radius: 8px;
        padding: 9px 12px; background: rgba(255,255,255,.1);
        transition: background .15s;
    }
    .fixture-item:hover   { background: rgba(255,255,255,.17); }
    .fixture-item.finished { opacity: .58; background: rgba(0,0,0,.14); }
    .match-no   { color:rgba(255,255,255,.65); font-size:11px; font-weight:950; text-transform:uppercase; }
    .match-time { color:var(--gold); font-size:16px; font-weight:950; white-space:nowrap; }
    .match-teams { font-size:clamp(14px,1.8vw,21px); font-weight:950; overflow-wrap:anywhere; }
    .match-meta  { color:rgba(255,255,255,.72); font-size:12px; font-weight:800; text-align:right; line-height:1.35; overflow-wrap:anywhere; }

    .poster-foot {
        display: flex; justify-content: space-between; gap: 14px;
        margin-top: 18px; color: rgba(255,255,255,.68); font-size:12px; font-weight:800;
    }

    @media (max-width: 980px) {
        .fixture-item { grid-template-columns: 56px 82px minmax(0,1fr); }
        .match-meta   { grid-column: 1 / -1; text-align: left; }
    }
    @media (max-width: 760px) {
        .filters      { grid-template-columns: 1fr 1fr; }
        .poster-head  { grid-template-columns: 1fr; }
        .date-group   { grid-template-columns: 1fr; }
        .poster-title { white-space: normal; font-size: clamp(26px,8vw,38px); }
        .poster-total { text-align: left; }
        .toolbar      { flex-direction: column; align-items: flex-start; }
        .btn-dl       { width: 100%; text-align: center; }
    }
    @media (max-width: 560px) {
        .filters      { grid-template-columns: 1fr; }
        .fixture-item { grid-template-columns: 1fr; gap: 4px; padding: 12px; }
        .poster::after { display: none; }
    }
</style>
@endsection

@section('hero')
<section class="hero">
    <div class="hero-inner">
        <p class="eyebrow">Bangladesh Time Schedule</p>
        <h1>সম্পূর্ণ ম্যাচ সূচি</h1>
        <p class="hero-copy">FIFA World Cup 2026-এর সব {{ $matchesByDate->sum(fn($g) => $g['matches']->count()) }}টি ম্যাচের সময়সূচি — BDT অনুযায়ী। ফিল্টার করুন, খুঁজুন, PNG ডাউনলোড করুন।</p>
    </div>
</section>
@endsection

@section('content')
    <div class="toolbar">
        <h2>{{ $matchesByDate->sum(fn($g) => $g['matches']->count()) }} টি ম্যাচ</h2>
        <button class="btn-dl" id="downloadBtn" type="button">↓ Download PNG</button>
    </div>

    <div class="filters">
        <input  class="f-input"  id="searchInput"  type="search" placeholder="Search team, venue, match no…">
        <select class="f-select" id="teamFilter">
            <option value="">All countries</option>
            @foreach ($fixtureTeams as $team)
                <option value="{{ $team }}">{{ $team }}</option>
            @endforeach
        </select>
        <select class="f-select" id="stageFilter">
            <option value="">All stages</option>
            @foreach ($fixtureStages as $stage)
                <option value="{{ $stage }}">{{ $stage }}</option>
            @endforeach
        </select>
        <select class="f-select" id="sortFilter">
            <option value="asc">Earliest first</option>
            <option value="desc">Latest first</option>
        </select>
        <label class="toggle-label">
            <input type="checkbox" id="hideFinished" checked>
            শেষ হওয়া লুকাও
        </label>
        <button class="btn-clear" id="clearBtn" type="button">Clear</button>
    </div>
    <p class="filter-info" id="filterInfo"></p>

    <div class="poster" id="poster">
        <div class="poster-head">
            <div>
                <p class="poster-kicker">BDT · UTC+6 · Bangladesh Time</p>
                <h2 class="poster-title">World Cup 2026</h2>
            </div>
            <div class="poster-total">
                <span>Total Fixtures</span>
                <strong>{{ $matchesByDate->sum(fn($g) => $g['matches']->count()) }}</strong>
            </div>
        </div>

        <div class="poster-dates" id="posterDates">
            @foreach ($matchesByDate as $group)
            <article class="date-group" data-group data-date="{{ $group['date']->format('Y-m-d') }}">
                <div class="date-label">
                    <strong>{{ $group['date']->format('M d') }}</strong>
                    <span>{{ $group['date']->format('l') }}</span>
                    <span>{{ $group['matches']->count() }} match{{ $group['matches']->count() > 1 ? 'es' : '' }}</span>
                </div>
                <div class="fixture-items">
                    @foreach ($group['matches'] as $match)
                    <div class="fixture-item {{ $match['status'] === 'finished' ? 'finished' : '' }}"
                        data-item
                        data-home="{{ Str::lower($match['home']) }}"
                        data-away="{{ Str::lower($match['away']) }}"
                        data-stage="{{ Str::lower($match['group_label']) }}"
                        data-no="{{ $match['match_number'] }}"
                        data-status="{{ $match['status'] }}"
                        data-search="{{ Str::lower('M'.$match['match_number'].' '.$match['time_label'].' '.$match['home'].' '.$match['away'].' '.$match['group_label'].' '.$match['venue']) }}">
                        <div class="match-no">M{{ $match['match_number'] }}</div>
                        <div class="match-time">{{ $match['time_label'] }}</div>
                        <div class="match-teams">{{ $match['home'] }} vs {{ $match['away'] }}</div>
                        <div class="match-meta">{{ $match['group_label'] }} / {{ $match['venue'] }}</div>
                    </div>
                    @endforeach
                </div>
            </article>
            @endforeach
        </div>

        <div class="poster-foot">
            <span>All kickoff times in Bangladesh Standard Time (BDT)</span>
            <span>FIFA World Cup 2026</span>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput  = document.getElementById('searchInput');
    const teamFilter   = document.getElementById('teamFilter');
    const stageFilter  = document.getElementById('stageFilter');
    const sortFilter   = document.getElementById('sortFilter');
    const hideFinished = document.getElementById('hideFinished');
    const clearBtn     = document.getElementById('clearBtn');
    const filterInfo   = document.getElementById('filterInfo');
    const posterDates  = document.getElementById('posterDates');
    const allItems     = [...document.querySelectorAll('[data-item]')];
    const allGroups    = [...document.querySelectorAll('[data-group]')];
    const total        = allItems.length;

    const norm = v => (v || '').trim().toLowerCase();

    const applySort = () => {
        const dir = sortFilter?.value === 'desc' ? -1 : 1;
        allGroups
            .sort((a, b) => dir * (a.dataset.date || '').localeCompare(b.dataset.date || ''))
            .forEach(g => {
                const wrap = g.querySelector('.fixture-items');
                [...g.querySelectorAll('[data-item]')]
                    .sort((a, b) => dir * (Number(a.dataset.no) - Number(b.dataset.no)))
                    .forEach(el => wrap?.append(el));
                posterDates?.append(g);
            });
    };

    const applyFilter = () => {
        const q     = norm(searchInput?.value);
        const team  = norm(teamFilter?.value);
        const stage = norm(stageFilter?.value);
        const hide  = hideFinished?.checked;
        let visible = 0;

        allItems.forEach(el => {
            const ok =
                (!q     || (el.dataset.search || '').includes(q)) &&
                (!team  || el.dataset.home === team || el.dataset.away === team) &&
                (!stage || el.dataset.stage === stage) &&
                (!hide  || el.dataset.status !== 'finished');
            el.hidden = !ok;
            if (ok) visible++;
        });

        allGroups.forEach(g => { g.hidden = !g.querySelector('[data-item]:not([hidden])'); });

        if (filterInfo) filterInfo.textContent = visible < total
            ? `${visible} of ${total} fixtures showing`
            : `${total} fixtures`;
    };

    const update = () => { applySort(); applyFilter(); };

    [searchInput, teamFilter, stageFilter, sortFilter, hideFinished].forEach(el => {
        el?.addEventListener('input', update);
        el?.addEventListener('change', update);
    });

    clearBtn?.addEventListener('click', () => {
        if (searchInput)  searchInput.value = '';
        if (teamFilter)   teamFilter.value  = '';
        if (stageFilter)  stageFilter.value = '';
        if (sortFilter)   sortFilter.value  = 'asc';
        if (hideFinished) hideFinished.checked = true;
        update();
    });

    document.getElementById('downloadBtn')?.addEventListener('click', async () => {
        const poster = document.getElementById('poster');
        if (!window.html2canvas || !poster) return;
        const canvas = await html2canvas(poster, { scale: 2, backgroundColor: null, useCORS: true });
        const a = document.createElement('a');
        a.download = `wc2026-fixtures-${Date.now()}.png`;
        a.href = canvas.toDataURL('image/png');
        a.click();
    });

    update();
});
</script>
@endsection
