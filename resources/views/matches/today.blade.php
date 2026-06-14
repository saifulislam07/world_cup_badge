@extends('layouts.wc')

@section('title', 'আজকের ম্যাচ — World Cup 2026')

@section('meta')
<meta name="description" content="FIFA World Cup 2026 আজকের ম্যাচ ও লাইভ স্কোর — Bangladesh Standard Time অনুযায়ী।">
<meta property="og:title" content="আজকের ম্যাচ — World Cup 2026">
@endsection

@section('styles')
<style>
    /* ── Summary ── */
    .summary { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; margin-bottom: 28px; }
    .big-count { font-size: 40px; line-height: 1; font-weight: 950; color: var(--green); margin: 6px 0; }

    /* ── Marquee ── */
    .marquee-wrap {
        margin-top: 20px; padding: 11px 0; overflow: hidden;
        border-top: 1px solid rgba(255,255,255,.18);
        border-bottom: 1px solid rgba(255,255,255,.18);
        background: rgba(255,255,255,.1);
    }
    .marquee {
        display: inline-flex; gap: 36px; white-space: nowrap;
        animation: marquee 50s linear infinite; font-weight: 950; color: #fff;
    }
    .marquee-wrap:hover .marquee { animation-play-state: paused; }
    @keyframes marquee { from { transform: translateX(100%); } to { transform: translateX(-100%); } }

    /* ── Status pills ── */
    .status-bar { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; align-items: center; }
    .pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 12px; border-radius: 999px;
        font-size: 12px; font-weight: 950; letter-spacing: .04em; text-transform: uppercase; border: 1px solid;
    }
    .pill-live     { background: rgba(214,40,57,.09);  color: var(--red);  border-color: rgba(214,40,57,.28); }
    .pill-upcoming { background: rgba(0,94,184,.09);   color: var(--blue); border-color: rgba(0,94,184,.28); }
    .pill-done     { background: rgba(71,84,103,.09);  color: #475467;     border-color: rgba(71,84,103,.22); }
    .pill-dot { width:6px; height:6px; border-radius:50%; background:currentColor; flex-shrink:0; animation: blink 1.1s ease-in-out infinite; }

    /* ── Today's match cards ── */
    .match-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(290px,1fr)); gap: 14px; }
    .match-card {
        display: grid; grid-template-columns: 1fr auto 1fr;
        gap: 10px; align-items: center;
        padding: 16px; background: var(--panel);
        border: 1px solid var(--line); border-radius: 10px;
        box-shadow: 0 16px 32px rgba(16,24,40,.06);
    }
    .team { font-size: clamp(15px,2.2vw,22px); line-height: 1.2; font-weight: 950; overflow-wrap: anywhere; }
    .team.away { text-align: right; }
    .kickoff {
        min-width: 84px; border-radius: 8px; padding: 10px;
        text-align: center; color: #fff; font-size: 13px;
        background: linear-gradient(135deg, var(--green), var(--blue));
    }
    .kickoff strong { display: block; font-size: 17px; }
    .kickoff.live { background: linear-gradient(135deg, var(--red), #9b1a28); }
    .kickoff.done { background: linear-gradient(135deg, #475467, #344054); }
    .kickoff-dot { display:inline-block; width:8px; height:8px; border-radius:50%; background:#fff; margin-bottom:4px; animation: blink 1.1s ease-in-out infinite; }
    .meta {
        grid-column: 1 / -1; display: flex; justify-content: space-between; gap: 10px;
        padding-top: 10px; border-top: 1px solid var(--line); color: var(--muted); font-size: 13px;
    }

    /* ── Live badge & refresh ── */
    .live-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red); color: #fff; border-radius: 999px;
        padding: 4px 12px; font-size: 11px; font-weight: 950; text-transform: uppercase; letter-spacing: .06em;
    }
    .pulse-dot { width:6px; height:6px; border-radius:50%; background:#fff; animation: blink 1.1s ease-in-out infinite; }
    .refresh-btn {
        margin-left: auto; padding: 8px 14px; border: 1px solid var(--line);
        border-radius: 8px; background: #fff; font-weight: 900; cursor: pointer;
        font-size: 13px; color: var(--ink); font-family: inherit; transition: all .15s;
    }
    .refresh-btn:hover { border-color: var(--green); color: var(--green); }

    /* ── API result cards ── */
    .result-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(280px,1fr)); gap: 14px; }
    .result-card {
        background: #fff; border: 1px solid var(--line); border-radius: 10px;
        padding: 16px 18px; box-shadow: 0 2px 12px rgba(16,24,40,.05); transition: box-shadow .15s;
    }
    .result-card:hover { box-shadow: 0 6px 20px rgba(16,24,40,.1); }
    .result-card.s-live     { border-color: var(--red); box-shadow: 0 4px 20px rgba(214,40,57,.13); }
    .result-card.s-finished { border-left: 4px solid var(--green); }
    .r-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
    .r-group  { font-size:11px; font-weight:950; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; }
    .r-status { font-size:11px; font-weight:950; padding:3px 9px; border-radius:999px; text-transform:uppercase; }
    .s-live     .r-status { background: var(--red);   color: #fff; }
    .s-finished .r-status { background: #e8f5ee; color: var(--green); }
    .s-scheduled .r-status { background: #eef2ff; color: var(--blue); }
    .r-teams { display:grid; grid-template-columns:1fr auto 1fr; align-items:center; gap:10px; margin:6px 0 10px; }
    .r-team { font-size:16px; font-weight:950; line-height:1.25; }
    .r-team.away  { text-align: right; }
    .r-team.loser { color: var(--red); }
    .r-score-box {
        min-width: 70px; border-radius: 8px; padding: 8px 10px;
        text-align: center; background: linear-gradient(135deg, var(--green), var(--blue)); color: #fff;
    }
    .r-score       { font-size: 24px; font-weight: 950; line-height: 1; }
    .r-score-label { font-size: 10px; opacity: .82; margin-top: 3px; }
    .r-footer {
        margin-top: 10px; padding-top: 10px; border-top: 1px solid var(--line);
        display: flex; justify-content: space-between; font-size: 12px; color: var(--muted); font-weight: 800; gap: 8px;
    }
    .goals-row {
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 4px 10px; margin-top: 8px; padding-top: 8px;
        border-top: 1px dashed var(--line); font-size: 11px; line-height: 1.5;
    }
    .goals-home { color: var(--ink); }
    .goals-away { color: var(--ink); text-align: right; }
    .goal-line  { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .goal-og    { color: var(--red); }
    .goal-pen   { color: var(--blue); }
    .skeleton    { background:#f5f7fa; border:1px solid var(--line); border-radius:10px; padding:28px 20px; text-align:center; color:var(--muted); font-weight:800; }
    .api-notice  { background:#fffbeb; border:1px solid var(--gold); border-radius:10px; padding:20px 24px; }
    .api-notice h3 { margin:0 0 8px; font-size:18px; }
    .api-notice code { background:#f0f4ff; border-radius:4px; padding:2px 6px; font-size:13px; }
    .api-notice a { color:var(--blue); text-decoration:underline; }

    @media (max-width: 760px) {
        .summary     { grid-template-columns: 1fr; gap: 12px; }
        .match-grid  { grid-template-columns: 1fr; }
        .result-grid { grid-template-columns: 1fr; }
        .meta        { flex-direction: column; }
        .refresh-btn { margin-left: 0; }
    }
</style>
@endsection

@section('hero')
<section class="hero">
    <div class="hero-inner">
        <p class="eyebrow">Bangladesh Time · আজকের খেলা</p>
        <h1>আজকের ম্যাচ</h1>
        <p class="hero-copy">World Cup 2026 — আজকের সব ম্যাচ ও লাইভ স্কোর, Bangladesh Standard Time (BDT) অনুযায়ী।</p>
        @if ($todayMatches->isNotEmpty())
            <div class="marquee-wrap">
                <div class="marquee">
                    @foreach ($todayMatches as $match)
                        <span>{{ $match['home'] }} vs {{ $match['away'] }} — {{ $match['time_label'] }} BDT</span>
                    @endforeach
                </div>
            </div>
        @elseif ($nextMatch)
            <div class="marquee-wrap">
                <div class="marquee">
                    <span>পরবর্তী ম্যাচ: {{ $nextMatch['home'] }} vs {{ $nextMatch['away'] }} — {{ $nextMatch['kickoff_bdt']->format('M j, h:i A') }} BDT</span>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('content')
    @php
        $liveCount     = $todayMatches->where('status','live')->count();
        $upcomingCount = $todayMatches->where('status','upcoming')->count();
        $finishedCount = $todayMatches->where('status','finished')->count();
    @endphp

    {{-- Summary cards --}}
    <div class="summary">
        <div class="panel">
            <h2>আজকের ম্যাচ</h2>
            <p class="muted">{{ $todayLabel }}</p>
            <div class="big-count">{{ $todayMatches->count() }}</div>
            <p class="muted">
                @if ($todayMatches->isEmpty())
                    আজ কোনো ম্যাচ নেই
                @else
                    @if($liveCount)
                        <span style="color:var(--red);font-weight:950">{{ $liveCount }} লাইভ</span>
                        @if($upcomingCount || $finishedCount) · @endif
                    @endif
                    @if($upcomingCount)
                        {{ $upcomingCount }} আসন্ন
                        @if($finishedCount) · @endif
                    @endif
                    @if($finishedCount){{ $finishedCount }} শেষ@endif
                @endif
            </p>
        </div>

        <div class="panel">
            <h2>পরবর্তী ম্যাচ</h2>
            @if ($nextMatch)
                <p style="margin:8px 0 4px"><strong>{{ $nextMatch['home'] }} vs {{ $nextMatch['away'] }}</strong></p>
                <p class="muted" style="margin:0">{{ $nextMatch['kickoff_bdt']->format('D, M j') }} — {{ $nextMatch['kickoff_bdt']->format('h:i A') }} BDT</p>
                <p class="muted" style="margin:4px 0 0;font-size:12px">{{ $nextMatch['group_label'] }} · {{ $nextMatch['venue'] }}</p>
            @else
                <p class="muted">টুর্নামেন্টের সব ম্যাচ শেষ।</p>
            @endif
        </div>

        <div class="panel">
            <h2>Bangladesh সময়</h2>
            <p class="muted">UTC +6:00</p>
            <div class="big-count" style="font-size:30px" id="bdtClock">--:--</div>
            <p class="muted" id="bdtDate">লোড হচ্ছে…</p>
        </div>
    </div>

    {{-- Today's match cards (from local DB) --}}
    @if ($todayMatches->isNotEmpty())
    <div class="section">
        @php
            $liveMatches     = $todayMatches->where('status','live');
            $upcomingMatches = $todayMatches->where('status','upcoming');
            $finishedMatches = $todayMatches->where('status','finished');
        @endphp
        <div class="status-bar">
            @if($liveMatches->isNotEmpty())     <span class="pill pill-live"><span class="pill-dot"></span>{{ $liveMatches->count() }} লাইভ</span> @endif
            @if($upcomingMatches->isNotEmpty()) <span class="pill pill-upcoming">{{ $upcomingMatches->count() }} আসন্ন</span> @endif
            @if($finishedMatches->isNotEmpty()) <span class="pill pill-done">{{ $finishedMatches->count() }} শেষ</span> @endif
        </div>
        <div class="match-grid">
            @foreach ($liveMatches as $m)
            <article class="match-card">
                <div class="team">{{ $m['home'] }}</div>
                <div class="kickoff live"><span class="kickoff-dot"></span><strong>লাইভ</strong><span>{{ $m['time_label'] }}</span></div>
                <div class="team away">{{ $m['away'] }}</div>
                <div class="meta"><span>{{ $m['group_label'] }}</span><span>{{ $m['venue'] }}</span></div>
            </article>
            @endforeach

            @foreach ($upcomingMatches as $m)
            <article class="match-card">
                <div class="team">{{ $m['home'] }}</div>
                <div class="kickoff"><span>Kickoff</span><strong>{{ $m['time_label'] }}</strong><span>BDT</span></div>
                <div class="team away">{{ $m['away'] }}</div>
                <div class="meta"><span>{{ $m['group_label'] }}</span><span>{{ $m['venue'] }}</span></div>
            </article>
            @endforeach

            @foreach ($finishedMatches as $m)
            <article class="match-card">
                <div class="team">{{ $m['home'] }}</div>
                <div class="kickoff done"><span>{{ $m['time_label'] }}</span><strong>শেষ</strong><span>FT</span></div>
                <div class="team away">{{ $m['away'] }}</div>
                <div class="meta"><span>{{ $m['group_label'] }}</span><span>{{ $m['venue'] }}</span></div>
            </article>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Live scores from football API --}}
    <div class="section">
        <div class="section-header">
            <h2>লাইভ স্কোর</h2>
            <span class="live-badge" id="liveBadge" hidden><span class="pulse-dot"></span> লাইভ</span>
            <button class="refresh-btn" id="refreshResults" type="button">↻ রিফ্রেশ</button>
        </div>
        <div id="resultsContainer"><div class="skeleton">স্কোর লোড হচ্ছে…</div></div>
    </div>
@endsection

@section('scripts')
<script>
(function () {
    const LIVE = ['IN_PLAY', 'PAUSED', 'HALFTIME'];
    const DONE = ['FINISHED', 'FULL_TIME', 'EXTRA_TIME', 'PENALTY_SHOOTOUT'];

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
                    ${isLive ? '<div class="r-score-label">লাইভ স্কোর</div>' : ''}
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

    async function loadResults() {
        const box   = document.getElementById('resultsContainer');
        const badge = document.getElementById('liveBadge');
        if (!box) return;
        try {
            const j = await fetch('/api/wc2026/results').then(r => r.json());
            if (!j.configured) {
                box.innerHTML = `<div class="api-notice">
                    <h3>⚙️ API Key প্রয়োজন</h3>
                    <p>Live score দেখতে <a href="https://www.football-data.org/client/register" target="_blank" rel="noopener">football-data.org</a>-এ রেজিস্ট্রেশন করে <code>.env</code>-এ <code>FOOTBALL_API_KEY=your_key</code> যোগ করুন।</p>
                </div>`;
                return;
            }
            if (j.error) { box.innerHTML = '<p class="muted" style="padding:16px">API থেকে ডেটা আনতে সমস্যা হয়েছে।</p>'; return; }
            const matches = j.data?.matches || [];
            if (!matches.length) { box.innerHTML = '<p class="muted" style="padding:16px">আজকের কোনো ম্যাচ স্কোর পাওয়া যায়নি।</p>'; return; }
            const hasLive = matches.some(m => LIVE.includes(m.status));
            if (badge) badge.hidden = !hasLive;
            box.innerHTML = `<div class="result-grid">${matches.map(renderCard).join('')}</div>`;
            if (hasLive) setTimeout(loadResults, 60000);
        } catch {
            box.innerHTML = '<p class="muted" style="padding:16px">স্কোর লোড করতে সমস্যা হয়েছে।</p>';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadResults();
        document.getElementById('refreshResults')?.addEventListener('click', loadResults);
    });

    /* BDT live clock */
    (function () {
        const clockEl = document.getElementById('bdtClock');
        const dateEl  = document.getElementById('bdtDate');
        if (!clockEl) return;
        const days = ['রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার','শনিবার'];
        function tick() {
            const now = new Date(Date.now() + 6 * 3600000);
            clockEl.textContent = `${String(now.getUTCHours()).padStart(2,'0')}:${String(now.getUTCMinutes()).padStart(2,'0')}:${String(now.getUTCSeconds()).padStart(2,'0')}`;
            if (dateEl) dateEl.textContent = `${days[now.getUTCDay()]}, ${now.toUTCString().slice(5,16)}`;
        }
        tick(); setInterval(tick, 1000);
    })();
})();
</script>
@endsection
