@extends('layouts.wc')

@section('title', 'পয়েন্ট টেবিল — World Cup 2026')

@section('meta')
<meta name="description" content="FIFA World Cup 2026 গ্রুপ পর্যায়ের পয়েন্ট টেবিল ও আজকের ম্যাচ স্কোর।">
<meta property="og:title" content="পয়েন্ট টেবিল — World Cup 2026">
@endsection

@section('styles')
<style>
    /* ── Refresh button ── */
    .refresh-btn {
        margin-left: auto; padding: 8px 14px;
        border: 1px solid var(--line); border-radius: 8px;
        background: #fff; font-weight: 900; cursor: pointer;
        font-size: 13px; color: var(--ink); font-family: inherit; transition: all .15s;
    }
    .refresh-btn:hover { border-color: var(--green); color: var(--green); }

    /* ── Live badge ── */
    .live-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red); color: #fff; border-radius: 999px;
        padding: 4px 12px; font-size: 11px; font-weight: 950; text-transform: uppercase; letter-spacing: .06em;
    }
    .pulse-dot { width:6px; height:6px; border-radius:50%; background:#fff; animation: blink 1.1s ease-in-out infinite; }

    /* ── API notice & skeleton ── */
    .skeleton   { background:#f5f7fa; border:1px solid var(--line); border-radius:10px; padding:32px 20px; text-align:center; color:var(--muted); font-weight:800; }
    .api-notice { background:#fffbeb; border:1px solid var(--gold); border-radius:10px; padding:22px 26px; }
    .api-notice h3 { margin:0 0 8px; font-size:18px; }
    .api-notice code { background:#f0f4ff; border-radius:4px; padding:2px 6px; font-size:13px; }
    .api-notice a { color:var(--blue); text-decoration:underline; }

    /* ── Group tabs ── */
    .tabs { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:16px; }
    .tab {
        padding: 8px 18px; border: 1px solid var(--line); border-radius: 999px;
        background: #fff; font-weight: 900; cursor: pointer; font-size: 14px;
        font-family: inherit; transition: all .15s;
    }
    .tab:hover  { border-color: var(--green); color: var(--green); }
    .tab.active { background: var(--green); color: #fff; border-color: var(--green); }
    .tab-panel         { display: none; overflow-x: auto; }
    .tab-panel.active  { display: block; }

    /* ── Standings table ── */
    .standings-table {
        width: 100%; border-collapse: collapse;
        background: #fff; border: 1px solid var(--line);
        border-radius: 10px; overflow: hidden;
        box-shadow: 0 4px 18px rgba(16,24,40,.06); font-size: 14px;
    }
    .standings-table thead th {
        background: linear-gradient(135deg, #063d2a, var(--blue));
        color: rgba(255,255,255,.92); padding: 11px 14px;
        font-size: 11px; font-weight: 950; text-transform: uppercase;
        letter-spacing: .07em; text-align: center; white-space: nowrap;
    }
    .standings-table thead th:first-child,
    .standings-table thead th:nth-child(2) { text-align: left; }
    .standings-table tbody td { padding: 11px 14px; border-bottom: 1px solid var(--line); text-align: center; vertical-align: middle; }
    .standings-table tbody td:first-child,
    .standings-table tbody td:nth-child(2) { text-align: left; }
    .standings-table tbody tr:last-child td { border-bottom: none; }
    .standings-table tbody tr:nth-child(-n+2) td { background: rgba(0,122,61,.04); }
    .standings-table tbody tr:hover td { background: rgba(0,94,184,.04); }
    .pos { display:inline-flex; width:24px; height:24px; align-items:center; justify-content:center; border-radius:50%; font-weight:950; font-size:12px; }
    .p1,.p2 { background:var(--green); color:#fff; }
    .p3      { background:var(--gold);  color:#101828; }
    .p4      { background:var(--line);  color:var(--muted); }
    .team-cell { font-weight:900; white-space:nowrap; }
    .pts-cell  { font-weight:950; font-size:16px; color:var(--green); }
    .gd-pos { color:var(--green); }
    .gd-neg { color:var(--red); }

    /* ── Today's result cards ── */
    .result-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(275px,1fr)); gap:14px; }
    .result-card {
        background:#fff; border:1px solid var(--line); border-radius:10px;
        padding:16px 18px; box-shadow:0 2px 12px rgba(16,24,40,.05); transition:box-shadow .15s;
    }
    .result-card:hover      { box-shadow:0 6px 20px rgba(16,24,40,.1); }
    .result-card.s-live     { border-color:var(--red); box-shadow:0 4px 20px rgba(214,40,57,.13); }
    .result-card.s-finished { border-left:4px solid var(--green); }
    .r-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
    .r-group  { font-size:11px; font-weight:950; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; }
    .r-status { font-size:11px; font-weight:950; padding:3px 9px; border-radius:999px; text-transform:uppercase; }
    .s-live      .r-status { background:var(--red);   color:#fff; }
    .s-finished  .r-status { background:#e8f5ee; color:var(--green); }
    .s-scheduled .r-status { background:#eef2ff; color:var(--blue); }
    .r-teams { display:grid; grid-template-columns:1fr auto 1fr; align-items:center; gap:10px; margin:6px 0 10px; }
    .r-team       { font-size:16px; font-weight:950; line-height:1.25; }
    .r-team.away  { text-align:right; }
    .r-team.loser { color:var(--red); }
    .r-score-box  { min-width:70px; border-radius:8px; padding:8px 10px; text-align:center; background:linear-gradient(135deg,var(--green),var(--blue)); color:#fff; }
    .r-score       { font-size:24px; font-weight:950; line-height:1; }
    .r-score-label { font-size:10px; opacity:.82; margin-top:3px; }
    .r-footer      { margin-top:10px; padding-top:10px; border-top:1px solid var(--line); display:flex; justify-content:space-between; font-size:12px; color:var(--muted); font-weight:800; gap:8px; }
    .goals-row  { display:grid; grid-template-columns:1fr 1fr; gap:4px 10px; margin-top:8px; padding-top:8px; border-top:1px dashed var(--line); font-size:11px; line-height:1.5; }
    .goals-home { color:var(--ink); }
    .goals-away { color:var(--ink); text-align:right; }
    .goal-line  { white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .goal-og    { color:var(--red); }
    .goal-pen   { color:var(--blue); }

    @media (max-width: 760px) {
        .result-grid { grid-template-columns: 1fr; }
        .refresh-btn { margin-left: 0; }
        .section-header { gap: 8px; }
    }
</style>
@endsection

@section('hero')
<section class="hero">
    <div class="hero-inner">
        <p class="eyebrow">Group Stage · Points Table</p>
        <h1>পয়েন্ট টেবিল</h1>
        <p class="hero-copy">FIFA World Cup 2026 গ্রুপ পর্যায়ের পয়েন্ট টেবিল ও আজকের ম্যাচ স্কোর — সরাসরি API থেকে রিয়েল-টাইম ডেটা।</p>
    </div>
</section>
@endsection

@section('content')
    {{-- Today's scores --}}
    <div class="section">
        <div class="section-header">
            <h2>আজকের স্কোর</h2>
            <span class="live-badge" id="liveBadge" hidden><span class="pulse-dot"></span> লাইভ</span>
            <button class="refresh-btn" id="refreshScores" type="button">↻ রিফ্রেশ</button>
        </div>
        <div id="scoresContainer"><div class="skeleton">স্কোর লোড হচ্ছে…</div></div>
    </div>

    {{-- Points table --}}
    <div class="section">
        <div class="section-header">
            <h2>গ্রুপ পয়েন্ট টেবিল</h2>
            <button class="refresh-btn" id="refreshStandings" type="button">↻ রিফ্রেশ</button>
        </div>
        <div id="standingsContainer"><div class="skeleton">পয়েন্ট টেবিল লোড হচ্ছে…</div></div>
    </div>
@endsection

@section('scripts')
<script>
(function () {
    const LIVE = ['IN_PLAY', 'PAUSED', 'HALFTIME'];
    const DONE = ['FINISHED', 'FULL_TIME', 'EXTRA_TIME', 'PENALTY_SHOOTOUT'];

    const NOTICE = `<div class="api-notice">
        <h3>⚙️ API Key প্রয়োজন</h3>
        <p>Live data দেখতে <a href="https://www.football-data.org/client/register" target="_blank" rel="noopener">football-data.org</a>-এ বিনামূল্যে রেজিস্ট্রেশন করে
        <code>.env</code>-এ <code>FOOTBALL_API_KEY=your_key</code> যোগ করুন।</p>
    </div>`;

    function bdtTime(utcStr) {
        const b = new Date(new Date(utcStr).getTime() + 6 * 3600000);
        const h = b.getUTCHours(), m = b.getUTCMinutes();
        return `${String(h % 12 || 12).padStart(2,'0')}:${String(m).padStart(2,'0')} ${h >= 12 ? 'PM' : 'AM'}`;
    }

    function statusBn(s, min) {
        if (s === 'IN_PLAY')  return min ? `${min}'` : 'লাইভ';
        if (s === 'HALFTIME' || s === 'PAUSED') return 'বিরতি';
        if (DONE.includes(s)) return 'শেষ';
        if (s === 'TIMED' || s === 'SCHEDULED') return 'নির্ধারিত';
        if (s === 'POSTPONED') return 'স্থগিত';
        if (s === 'CANCELLED') return 'বাতিল';
        return s;
    }

    function cardCls(s) { return LIVE.includes(s) ? 's-live' : DONE.includes(s) ? 's-finished' : 's-scheduled'; }

    function getScore(m) {
        const ft = m.score?.fullTime;
        if (ft && ft.home !== null) return `${ft.home} – ${ft.away}`;
        if (LIVE.includes(m.status)) {
            const ht = m.score?.halfTime;
            return (ht && ht.home !== null) ? `${ht.home} – ${ht.away}` : '– –';
        }
        return 'vs';
    }

    function fmtGoal(g) {
        const lastName = (g.scorer?.name || '?').split(' ').pop();
        const min      = g.injuryTime ? `${g.minute}+${g.injuryTime}'` : `${g.minute}'`;
        const cls      = g.type === 'OWN_GOAL' ? ' goal-og' : g.type === 'PENALTY' ? ' goal-pen' : '';
        const tag      = g.type === 'OWN_GOAL' ? ' (OG)' : g.type === 'PENALTY' ? ' (P)' : '';
        return `<div class="goal-line${cls}">⚽ ${lastName} ${min}${tag}</div>`;
    }

    function renderGoals(m) {
        if (!m.goals?.length) return '';
        const homeId    = m.homeTeam?.id;
        const homeGoals = m.goals.filter(g => g.team?.id === homeId);
        const awayGoals = m.goals.filter(g => g.team?.id !== homeId);
        if (!homeGoals.length && !awayGoals.length) return '';
        return `<div class="goals-row">
            <div class="goals-home">${homeGoals.map(fmtGoal).join('')}</div>
            <div class="goals-away">${awayGoals.map(fmtGoal).join('')}</div>
        </div>`;
    }

    function renderCard(m) {
        const home  = m.homeTeam?.shortName || m.homeTeam?.name || '?';
        const away  = m.awayTeam?.shortName || m.awayTeam?.name || '?';
        const group = m.group ? m.group.replace('GROUP_', 'গ্রুপ ') : (m.stage || '');
        const isLive = LIVE.includes(m.status);
        const isDone = DONE.includes(m.status);
        const ft = m.score?.fullTime;
        const hs = ft?.home, as_ = ft?.away;
        const homeLoser = isDone && hs !== null && as_ !== null && hs < as_;
        const awayLoser = isDone && hs !== null && as_ !== null && as_ < hs;
        return `<div class="result-card ${cardCls(m.status)}">
            <div class="r-header">
                <span class="r-group">${group}</span>
                <span class="r-status">${statusBn(m.status, m.minute)}</span>
            </div>
            <div class="r-teams">
                <div class="r-team${homeLoser ? ' loser' : ''}">${home}</div>
                <div class="r-score-box">
                    <div class="r-score">${getScore(m)}</div>
                    ${isLive ? '<div class="r-score-label">লাইভ</div>' : ''}
                </div>
                <div class="r-team away${awayLoser ? ' loser' : ''}">${away}</div>
            </div>
            ${renderGoals(m)}
            <div class="r-footer">
                <span>🕐 ${bdtTime(m.utcDate)} BDT</span>
                <span>${(m.venue?.name || '').split(',')[0]}</span>
            </div>
        </div>`;
    }

    async function loadScores() {
        const box   = document.getElementById('scoresContainer');
        const badge = document.getElementById('liveBadge');
        if (!box) return;
        try {
            const j = await fetch('/api/wc2026/results').then(r => r.json());
            if (!j.configured) { box.innerHTML = NOTICE; return; }
            if (j.error) { box.innerHTML = '<p class="muted" style="padding:16px">API থেকে ডেটা আনতে সমস্যা হয়েছে।</p>'; return; }
            const matches = j.data?.matches || [];
            if (!matches.length) { box.innerHTML = '<p class="muted" style="padding:16px">আজকের কোনো ম্যাচ স্কোর পাওয়া যায়নি।</p>'; return; }
            const hasLive = matches.some(m => LIVE.includes(m.status));
            if (badge) badge.hidden = !hasLive;
            box.innerHTML = `<div class="result-grid">${matches.map(renderCard).join('')}</div>`;
            if (hasLive) setTimeout(loadScores, 60000);
        } catch {
            box.innerHTML = '<p class="muted" style="padding:16px">স্কোর লোড করতে সমস্যা হয়েছে।</p>';
        }
    }

    async function loadStandings() {
        const box = document.getElementById('standingsContainer');
        if (!box) return;
        try {
            const j = await fetch('/api/wc2026/standings').then(r => r.json());
            if (!j.configured) { box.innerHTML = NOTICE; return; }
            if (j.error) { box.innerHTML = '<p class="muted" style="padding:16px">API থেকে ডেটা আনতে সমস্যা হয়েছে।</p>'; return; }

            const groups = (j.data?.standings || []).filter(s => s.type === 'TOTAL');
            if (!groups.length) { box.innerHTML = '<p class="muted" style="padding:16px">পয়েন্ট টেবিল এখনো পাওয়া যায়নি।</p>'; return; }

            const tabs = groups.map((g, i) => {
                const label = g.group ? g.group.replace('GROUP_', 'Group ') : `Group ${i + 1}`;
                return `<button class="tab${i === 0 ? ' active' : ''}" data-idx="${i}">${label}</button>`;
            }).join('');

            const panels = groups.map((g, i) => {
                const rows = (g.table || []).map(r => {
                    const p    = r.position;
                    const pCls = p <= 2 ? `p${p}` : p === 3 ? 'p3' : 'p4';
                    const gd   = r.goalDifference;
                    const gdHtml = gd > 0
                        ? `<span class="gd-pos">+${gd}</span>`
                        : gd < 0 ? `<span class="gd-neg">${gd}</span>` : gd;
                    return `<tr>
                        <td><span class="pos ${pCls}">${p}</span></td>
                        <td class="team-cell">${r.team?.shortName || r.team?.name || '?'}</td>
                        <td>${r.playedGames}</td>
                        <td>${r.won}</td>
                        <td>${r.draw}</td>
                        <td>${r.lost}</td>
                        <td>${r.goalsFor}</td>
                        <td>${r.goalsAgainst}</td>
                        <td>${gdHtml}</td>
                        <td class="pts-cell">${r.points}</td>
                    </tr>`;
                }).join('');
                return `<div class="tab-panel${i === 0 ? ' active' : ''}" data-panel="${i}">
                    <table class="standings-table">
                        <thead><tr>
                            <th>#</th><th>দল</th><th>ম্যাচ</th><th>জয়</th>
                            <th>ড্র</th><th>হার</th><th>GF</th><th>GA</th><th>GD</th><th>পয়েন্ট</th>
                        </tr></thead>
                        <tbody>${rows}</tbody>
                    </table>
                </div>`;
            }).join('');

            box.innerHTML = `<div class="tabs">${tabs}</div><div>${panels}</div>`;

            box.querySelectorAll('.tab').forEach(btn => {
                btn.addEventListener('click', () => {
                    const idx = btn.dataset.idx;
                    box.querySelectorAll('.tab').forEach(b => b.classList.remove('active'));
                    box.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
                    btn.classList.add('active');
                    box.querySelector(`.tab-panel[data-panel="${idx}"]`).classList.add('active');
                });
            });
        } catch {
            box.innerHTML = '<p class="muted" style="padding:16px">পয়েন্ট টেবিল লোড করতে সমস্যা হয়েছে।</p>';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadScores();
        loadStandings();
        document.getElementById('refreshScores')?.addEventListener('click', loadScores);
        document.getElementById('refreshStandings')?.addEventListener('click', loadStandings);
    });
})();
</script>
@endsection
