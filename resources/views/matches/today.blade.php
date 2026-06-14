<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>World Cup 2026 Fixture Schedule - Bangladesh Time</title>
    <meta name="description" content="FIFA World Cup 2026 ম্যাচ সূচি — আজকের ম্যাচ, লাইভ স্কোর ও পয়েন্ট টেবিল। সব সময় Bangladesh Standard Time (BDT) অনুযায়ী।">
    <meta property="og:type" content="website">
    <meta property="og:title" content="World Cup 2026 ম্যাচ সূচি — Bangladesh Time">
    <meta property="og:description" content="আজকের ম্যাচ, লাইভ স্কোর ও পয়েন্ট টেবিল — সব BDT সময়ে।">
    <meta property="og:image" content="{{ url('images/wc2026-mascot.jpg') }}">
    <meta property="og:image:width" content="696">
    <meta property="og:image:height" content="464">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="World Cup 2026 ম্যাচ সূচি — Bangladesh Time">
    <meta name="twitter:description" content="আজকের ম্যাচ, লাইভ স্কোর ও পয়েন্ট টেবিল — সব BDT সময়ে।">
    <meta name="twitter:image" content="{{ url('images/wc2026-mascot.jpg') }}">
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js" defer></script>
    <style>
        :root {
            --ink: #101828;
            --muted: #667085;
            --line: #d0d5dd;
            --green: #007a3d;
            --deep: #063d2a;
            --blue: #005eb8;
            --gold: #ffb703;
            --red: #d62839;
            --panel: #ffffff;
            --page-gutter: 3vw;
        }

        * {
            box-sizing: border-box;
        }

        [hidden] {
            display: none !important;
        }

        body {
            margin: 0;
            color: var(--ink);
            background:
                linear-gradient(180deg, rgba(255, 255, 255, .92), rgba(246, 248, 251, .98)),
                repeating-linear-gradient(90deg, rgba(0, 122, 61, .05) 0 72px, rgba(0, 94, 184, .04) 72px 144px);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, sans-serif;
            overflow-x: hidden;
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
            background: rgba(255, 255, 255, .94);
            border-bottom: 1px solid var(--line);
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
            min-width: 0;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #fff;
            background: linear-gradient(135deg, var(--green), var(--blue));
            box-shadow: 0 10px 22px rgba(0, 122, 61, .22);
        }

        .nav {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            min-width: 0;
        }

        .nav a,
        .download-button {
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 10px 15px;
            font-weight: 900;
            background: #fff;
            cursor: pointer;
        }

        .download-button {
            border: 0;
            color: #fff;
            background: linear-gradient(135deg, var(--green), var(--blue));
            box-shadow: 0 14px 26px rgba(0, 122, 61, .22);
        }

        .hero {
            min-height: 278px;
            padding: 38px var(--page-gutter) 28px;
            display: grid;
            align-items: end;
            color: #fff;
            background:
                linear-gradient(90deg, rgba(6, 61, 42, .97), rgba(0, 94, 184, .82)),
                radial-gradient(circle at 84% 20%, rgba(255, 183, 3, .42), transparent 26%),
                linear-gradient(135deg, #063d2a, #005eb8);
            overflow: hidden;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            right: var(--page-gutter);
            bottom: -78px;
            width: min(390px, 58vw);
            aspect-ratio: 1;
            border: 18px solid rgba(255, 255, 255, .13);
            border-radius: 50%;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--gold);
            font-size: 13px;
            font-weight: 950;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            max-width: 940px;
            font-size: clamp(36px, 5vw, 64px);
            line-height: .98;
            letter-spacing: 0;
            overflow-wrap: anywhere;
        }

        .hero-copy {
            max-width: 790px;
            margin: 14px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: clamp(15px, 1.35vw, 18px);
            line-height: 1.5;
            white-space: nowrap;
        }

        .marquee-wrap {
            margin-top: 24px;
            padding: 12px 0;
            overflow: hidden;
            border-top: 1px solid rgba(255, 255, 255, .18);
            border-bottom: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .1);
        }

        .marquee {
            min-width: 100%;
            display: inline-flex;
            gap: 34px;
            white-space: nowrap;
            animation: marquee 46s linear infinite;
            font-weight: 950;
        }

        .marquee-wrap:hover .marquee {
            animation-play-state: paused;
        }

        .marquee span {
            color: #fff;
        }

        @keyframes marquee {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        main {
            width: 100%;
            margin: 28px auto 42px;
            padding: 0 var(--page-gutter);
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 18px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 18px 36px rgba(16, 24, 40, .06);
        }

        .panel h2 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .muted {
            color: var(--muted);
            line-height: 1.5;
        }

        .count {
            margin: 4px 0;
            color: var(--green);
            font-size: 46px;
            line-height: 1;
            font-weight: 950;
        }

        .match-list {
            margin-bottom: 22px;
        }

        .match-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 14px;
        }

        .match-card {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 12px;
            align-items: center;
            padding: 16px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 18px 36px rgba(16,24,40,.06);
        }

        .team {
            min-width: 0;
            font-size: clamp(16px, 2.4vw, 24px);
            line-height: 1.2;
            font-weight: 950;
            overflow-wrap: anywhere;
        }

        .team.away {
            text-align: right;
        }

        .kickoff {
            min-width: 90px;
            border-radius: 8px;
            padding: 10px 12px;
            text-align: center;
            color: #fff;
            font-size: 13px;
            background: linear-gradient(135deg, var(--green), var(--blue));
        }

        .kickoff strong {
            display: block;
            font-size: 18px;
        }

        .kickoff.kickoff--live {
            background: linear-gradient(135deg, var(--red), #9b1a28);
        }

        .kickoff.kickoff--done {
            background: linear-gradient(135deg, #475467, #344054);
        }

        .kickoff-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #fff;
            margin-bottom: 4px;
            animation: blink 1.1s ease-in-out infinite;
        }

        .match-status-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
            align-items: center;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 950;
            letter-spacing: .04em;
            text-transform: uppercase;
            border: 1px solid;
        }

        .pill-live {
            background: rgba(214,40,57,.09);
            color: var(--red);
            border-color: rgba(214,40,57,.28);
        }

        .pill-upcoming {
            background: rgba(0,94,184,.09);
            color: var(--blue);
            border-color: rgba(0,94,184,.28);
        }

        .pill-done {
            background: rgba(71,84,103,.09);
            color: #475467;
            border-color: rgba(71,84,103,.22);
        }

        .pill-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
            animation: blink 1.1s ease-in-out infinite;
        }

        .meta {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 14px;
        }

        .empty {
            text-align: left;
            padding: 20px;
        }

        .empty strong {
            display: block;
            margin-bottom: 8px;
            font-size: 24px;
        }

        .fixture-tools {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 14px;
        }

        .fixture-tools h2 {
            margin: 0;
            font-size: 26px;
            overflow-wrap: anywhere;
        }

        .fixture-filters {
            display: grid;
            grid-template-columns: minmax(220px, 1fr) 220px 190px 190px auto;
            gap: 10px;
            margin-bottom: 14px;
        }

        .fixture-filters>* {
            min-width: 0;
        }

        .fixture-filters input,
        .fixture-filters select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 12px 13px;
            color: var(--ink);
            background: #fff;
            outline: none;
        }

        .fixture-filters input:focus,
        .fixture-filters select:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 4px rgba(0, 122, 61, .12);
        }

        .clear-button {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 12px 15px;
            color: var(--ink);
            background: #fff;
            font-weight: 900;
            cursor: pointer;
        }

        .filter-status {
            margin: -4px 0 14px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 800;
        }

        .fixture-poster {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            border-radius: 8px;
            padding: clamp(18px, 2.6vw, 34px);
            color: #fff;
            background:
                linear-gradient(135deg, rgba(6, 61, 42, .97) 0%, rgba(0, 94, 184, .94) 62%, rgba(8, 27, 58, .98) 100%),
                repeating-linear-gradient(90deg, rgba(255, 255, 255, .08) 0 80px, transparent 80px 160px);
            box-shadow: 0 26px 60px rgba(16, 24, 40, .2);
            overflow: hidden;
            position: relative;
        }

        .fixture-poster::before {
            content: "";
            position: absolute;
            inset: 18px;
            border: 2px solid rgba(255, 255, 255, .15);
            border-radius: 8px;
            pointer-events: none;
        }

        .fixture-poster::after {
            content: "";
            position: absolute;
            right: clamp(18px, 5vw, 80px);
            top: 34px;
            width: 260px;
            aspect-ratio: 1;
            border: 16px solid rgba(255, 255, 255, .08);
            border-radius: 50%;
            pointer-events: none;
        }

        .fixture-head,
        .fixture-dates,
        .fixture-footer {
            position: relative;
            z-index: 1;
        }

        .fixture-head {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 18px;
            align-items: end;
            margin-bottom: 22px;
        }

        .fixture-kicker {
            margin: 0 0 8px;
            color: var(--gold);
            font-size: 13px;
            font-weight: 950;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .fixture-title {
            margin: 0;
            max-width: none;
            font-size: clamp(34px, 4.1vw, 70px);
            line-height: .95;
            white-space: nowrap;
        }

        .fixture-total {
            min-width: 154px;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 8px;
            padding: 14px;
            text-align: right;
            background: rgba(255, 255, 255, .1);
        }

        .fixture-total strong {
            display: block;
            font-size: 34px;
            line-height: 1;
        }

        .fixture-dates {
            display: grid;
            gap: 12px;
        }

        .fixture-date-group {
            display: grid;
            grid-template-columns: 188px minmax(0, 1fr);
            gap: 12px;
            align-items: stretch;
        }

        .fixture-date {
            border-radius: 8px;
            padding: 14px;
            color: #101828;
            background: var(--gold);
            font-weight: 950;
        }

        .fixture-date strong {
            display: block;
            font-size: 28px;
            line-height: 1;
        }

        .fixture-date span {
            display: block;
            margin-top: 5px;
            font-size: 13px;
        }

        .fixture-items {
            display: grid;
            gap: 8px;
        }

        .fixture-item {
            display: grid;
            grid-template-columns: 72px 92px minmax(220px, 1fr) minmax(190px, .9fr);
            gap: 12px;
            align-items: center;
            min-height: 52px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 8px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, .11);
        }

        .fixture-match-no {
            color: rgba(255, 255, 255, .7);
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
        }

        .fixture-time {
            color: var(--gold);
            font-size: 17px;
            font-weight: 950;
            white-space: nowrap;
        }

        .fixture-teams {
            min-width: 0;
            font-size: clamp(16px, 2vw, 23px);
            font-weight: 950;
            overflow-wrap: anywhere;
        }

        .fixture-meta {
            color: rgba(255, 255, 255, .74);
            font-size: 12px;
            font-weight: 800;
            text-align: right;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .fixture-footer {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            margin-top: 18px;
            color: rgba(255, 255, 255, .76);
            font-size: 13px;
            font-weight: 800;
        }

        @media (max-width: 980px) {
            .fixture-item {
                grid-template-columns: 68px 88px minmax(0, 1fr);
            }

            .fixture-meta {
                grid-column: 1 / -1;
                text-align: left;
            }
        }

        @media (max-width: 760px) {
            :root {
                --page-gutter: 14px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .brand {
                width: 100%;
                font-size: 15px;
            }

            .nav {
                width: 100%;
                gap: 8px;
            }

            .nav a {
                flex: 1 1 calc(50% - 8px);
                text-align: center;
                padding: 9px 10px;
                font-size: 13px;
            }

            .hero {
                min-height: auto;
                padding-top: 28px;
                padding-bottom: 22px;
            }

            .hero::after {
                right: -90px;
                bottom: -80px;
                width: 260px;
                border-width: 12px;
            }

            h1 {
                font-size: clamp(30px, 10vw, 44px);
            }

            .hero-copy {
                font-size: 15px;
            }

            .summary {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .hero-copy {
                white-space: normal;
            }

            .match-grid {
                grid-template-columns: 1fr;
            }

            .team.away {
                text-align: right;
            }

            .meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .fixture-tools,
            .fixture-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .download-button {
                width: 100%;
            }

            .fixture-filters {
                grid-template-columns: 1fr 1fr;
            }

            .fixture-head,
            .fixture-date-group {
                grid-template-columns: 1fr;
            }

            .fixture-title {
                white-space: normal;
                font-size: clamp(30px, 9vw, 44px);
            }

            .fixture-total {
                width: 100%;
                text-align: left;
            }

            .fixture-poster {
                padding: 18px 14px;
            }

            .fixture-poster::before {
                inset: 10px;
            }

            .fixture-poster::after {
                display: none;
            }
        }

        /* ── Live Scores & Standings ───────────────────────────────── */
        .api-section {
            margin-bottom: 32px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 26px;
        }

        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--red);
            color: #fff;
            border-radius: 999px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .pulse-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #fff;
            animation: blink 1.1s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .35; transform: scale(.78); }
        }

        .refresh-btn {
            margin-left: auto;
            padding: 9px 16px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fff;
            font-weight: 900;
            cursor: pointer;
            font-size: 14px;
            color: var(--ink);
            transition: border-color .15s, color .15s;
        }

        .refresh-btn:hover { border-color: var(--green); color: var(--green); }

        .loading-skeleton {
            background: #f5f7fa;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 28px 20px;
            text-align: center;
            color: var(--muted);
            font-weight: 800;
        }

        .api-notice {
            background: #fffbeb;
            border: 1px solid var(--gold);
            border-radius: 10px;
            padding: 20px 24px;
        }

        .api-notice h3 { margin: 0 0 8px; font-size: 18px; }
        .api-notice code { background: #f0f4ff; border-radius: 4px; padding: 2px 6px; font-size: 13px; }
        .api-notice a { color: var(--blue); text-decoration: underline; }

        /* Result cards */
        .result-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 14px;
        }

        .result-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 16px 18px;
            box-shadow: 0 2px 12px rgba(16,24,40,.05);
            transition: box-shadow .15s;
        }

        .result-card:hover { box-shadow: 0 6px 20px rgba(16,24,40,.1); }
        .result-card.s-live { border-color: var(--red); box-shadow: 0 4px 20px rgba(214,40,57,.13); }
        .result-card.s-finished { border-left: 4px solid var(--green); }

        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .result-group {
            font-size: 12px;
            font-weight: 950;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .result-status {
            font-size: 11px;
            font-weight: 950;
            padding: 3px 9px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .s-live .result-status { background: var(--red); color: #fff; }
        .s-finished .result-status { background: #e8f5ee; color: var(--green); }
        .s-scheduled .result-status { background: #eef2ff; color: var(--blue); }
        .s-paused .result-status { background: var(--gold); color: #101828; }

        .result-teams {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 10px;
            margin: 6px 0 10px;
        }

        .result-team {
            font-size: 17px;
            font-weight: 950;
            line-height: 1.25;
        }

        .result-team.away { text-align: right; }

        .result-score-box {
            min-width: 78px;
            border-radius: 8px;
            padding: 8px 10px;
            text-align: center;
            background: linear-gradient(135deg, var(--green), var(--blue));
            color: #fff;
        }

        .result-score { font-size: 26px; font-weight: 950; line-height: 1; }
        .result-score-label { font-size: 10px; opacity: .82; margin-top: 3px; }

        .result-footer {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid var(--line);
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--muted);
            font-weight: 800;
            gap: 8px;
        }

        /* Standings */
        .standings-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .std-tab {
            padding: 8px 18px;
            border: 1px solid var(--line);
            border-radius: 999px;
            background: #fff;
            font-weight: 900;
            cursor: pointer;
            font-size: 14px;
            color: var(--ink);
            transition: all .15s;
        }

        .std-tab:hover { border-color: var(--green); color: var(--green); }
        .std-tab.active { background: var(--green); color: #fff; border-color: var(--green); }

        .std-panel { display: none; overflow-x: auto; }
        .std-panel.active { display: block; }

        .standings-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(16,24,40,.06);
            font-size: 14px;
        }

        .standings-table thead th {
            background: linear-gradient(135deg, #063d2a, var(--blue));
            color: rgba(255,255,255,.92);
            padding: 11px 14px;
            font-size: 11px;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .07em;
            text-align: center;
            white-space: nowrap;
        }

        .standings-table thead th:first-child,
        .standings-table thead th:nth-child(2) { text-align: left; }

        .standings-table tbody td {
            padding: 11px 14px;
            border-bottom: 1px solid var(--line);
            text-align: center;
            vertical-align: middle;
        }

        .standings-table tbody td:first-child,
        .standings-table tbody td:nth-child(2) { text-align: left; }
        .standings-table tbody tr:last-child td { border-bottom: none; }
        .standings-table tbody tr:nth-child(1) td,
        .standings-table tbody tr:nth-child(2) td { background: rgba(0,122,61,.04); }
        .standings-table tbody tr:hover td { background: rgba(0,94,184,.04); }

        .pos-num {
            display: inline-flex;
            width: 24px;
            height: 24px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 950;
            font-size: 12px;
        }

        .p1, .p2 { background: var(--green); color: #fff; }
        .p3 { background: var(--gold); color: #101828; }
        .p4 { background: var(--line); color: var(--muted); }

        .team-cell { font-weight: 900; white-space: nowrap; }
        .pts-cell { font-weight: 950; font-size: 16px; color: var(--green); }
        .gd-pos { color: var(--green); }
        .gd-neg { color: var(--red); }

        @media (max-width: 760px) {
            .result-grid { grid-template-columns: 1fr; }
            .section-header { gap: 8px; }
            .refresh-btn { margin-left: 0; }
        }

        @media (max-width: 560px) {
            .nav a {
                flex-basis: 100%;
            }

            h1 {
                font-size: 32px;
            }

            .fixture-tools h2 {
                font-size: 22px;
            }

            .fixture-item {
                grid-template-columns: 1fr;
                gap: 5px;
                padding: 12px;
            }

            .fixture-filters {
                grid-template-columns: 1fr;
            }

            .fixture-time {
                font-size: 20px;
            }

            .panel,
            .match-card {
                padding: 16px;
            }

            .fixture-date {
                padding: 12px;
            }

            .fixture-date strong {
                font-size: 24px;
            }

            .marquee {
                animation-duration: 60s;
            }
        }
    </style>
</head>

<body>
    <header class="topbar">
        <div class="brand"><span class="brand-mark">26</span>World Cup 2026 Badge Maker</div>
        <nav class="nav">
            <a href="{{ route('home') }}">Badge Maker</a>
            <a href="{{ route('country-ranking') }}">Ranking</a>
            {{-- <a href="{{ route('admin.login') }}">Admin</a> --}}
        </nav>
    </header>

    <section class="hero">
        <div class="hero-inner">
            <p class="eyebrow">Bangladesh Time Fixture Guide</p>
            <h1>World Cup 2026 ম্যাচ সূচি</h1>
            <p class="hero-copy">আজকের ম্যাচ, পরবর্তী ম্যাচ এবং সম্পূর্ণ fixture schedule এক জায়গায় দেখুন। সব সময়
                Bangladesh Standard Time অনুযায়ী সাজানো।</p>
            <div class="marquee-wrap">
                <div class="marquee">
                    @forelse ($todayMatches as $match)
                        <span>{{ $match['home'] }} vs {{ $match['away'] }} - {{ $match['time_label'] }} BDT</span>
                    @empty
                        <span>আজ Bangladesh সময় অনুযায়ী World Cup 2026-এর কোনো ম্যাচ নেই</span>
                        @if ($nextMatch)
                            <span>পরবর্তী ম্যাচ: {{ $nextMatch['home'] }} vs {{ $nextMatch['away'] }} -
                                {{ $nextMatch['kickoff_bdt']->format('F j, h:i A') }} BDT</span>
                        @endif
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="summary">
            @php
                $liveCount     = $todayMatches->where('status', 'live')->count();
                $upcomingCount = $todayMatches->where('status', 'upcoming')->count();
                $finishedCount = $todayMatches->where('status', 'finished')->count();
            @endphp
            <div class="panel">
                <h2>আজকের ম্যাচ</h2>
                <p class="muted">{{ $todayLabel }}</p>
                <div class="count">{{ $todayMatches->count() }}</div>
                <p class="muted">
                    @if ($todayMatches->isEmpty())
                        আজ কোনো ম্যাচ নেই
                    @else
                        @if ($liveCount > 0)<span style="color:var(--red);font-weight:950">{{ $liveCount }} লাইভ</span>{{ ($upcomingCount > 0 || $finishedCount > 0) ? ' · ' : '' }}@endif
                        @if ($upcomingCount > 0){{ $upcomingCount }} আসন্ন{{ $finishedCount > 0 ? ' · ' : '' }}@endif
                        @if ($finishedCount > 0){{ $finishedCount }} শেষ@endif
                    @endif
                </p>
            </div>

            <div class="panel">
                <h2>পরবর্তী ম্যাচ</h2>
                @if ($nextMatch)
                    <p style="margin:8px 0 4px"><strong>{{ $nextMatch['home'] }} vs {{ $nextMatch['away'] }}</strong></p>
                    <p class="muted" style="margin:0">{{ $nextMatch['kickoff_bdt']->format('D, M j') }} — {{ $nextMatch['kickoff_bdt']->format('h:i A') }} BDT</p>
                    <p class="muted" style="margin:4px 0 0;font-size:13px">{{ $nextMatch['group_label'] }} · {{ $nextMatch['venue'] }}</p>
                @else
                    <p class="muted">টুর্নামেন্টের সব ম্যাচ শেষ।</p>
                @endif
            </div>

            <div class="panel">
                <h2>Bangladesh সময়</h2>
                <p class="muted">UTC +6:00 (BST)</p>
                <div class="count" style="font-size:32px" id="bdtClock">--:--</div>
                <p class="muted" id="bdtDate">লোড হচ্ছে…</p>
            </div>
        </section>

        @if ($todayMatches->isNotEmpty())
            <section class="match-list">
                @php
                    $liveMatches     = $todayMatches->where('status', 'live');
                    $upcomingMatches = $todayMatches->where('status', 'upcoming');
                    $finishedMatches = $todayMatches->where('status', 'finished');
                @endphp

                <div class="match-status-bar">
                    @if ($liveMatches->isNotEmpty())
                        <span class="status-pill pill-live"><span class="pill-dot"></span>{{ $liveMatches->count() }} লাইভ চলছে</span>
                    @endif
                    @if ($upcomingMatches->isNotEmpty())
                        <span class="status-pill pill-upcoming">{{ $upcomingMatches->count() }} আসন্ন ম্যাচ</span>
                    @endif
                    @if ($finishedMatches->isNotEmpty())
                        <span class="status-pill pill-done">{{ $finishedMatches->count() }} শেষ হয়েছে</span>
                    @endif
                </div>

                <div class="match-grid">
                    @foreach ($liveMatches as $match)
                        <article class="match-card">
                            <div class="team">{{ $match['home'] }}</div>
                            <div class="kickoff kickoff--live">
                                <span class="kickoff-dot"></span>
                                <strong>লাইভ</strong>
                                <span>{{ $match['time_label'] }}</span>
                            </div>
                            <div class="team away">{{ $match['away'] }}</div>
                            <div class="meta">
                                <span>{{ $match['group_label'] }}</span>
                                <span>{{ $match['venue'] }}</span>
                            </div>
                        </article>
                    @endforeach

                    @foreach ($upcomingMatches as $match)
                        <article class="match-card">
                            <div class="team">{{ $match['home'] }}</div>
                            <div class="kickoff">
                                <span>Kickoff</span>
                                <strong>{{ $match['time_label'] }}</strong>
                                <span>BDT</span>
                            </div>
                            <div class="team away">{{ $match['away'] }}</div>
                            <div class="meta">
                                <span>{{ $match['group_label'] }}</span>
                                <span>{{ $match['venue'] }}</span>
                            </div>
                        </article>
                    @endforeach

                    @foreach ($finishedMatches as $match)
                        <article class="match-card">
                            <div class="team">{{ $match['home'] }}</div>
                            <div class="kickoff kickoff--done">
                                <span>{{ $match['time_label'] }}</span>
                                <strong>শেষ</strong>
                                <span>FT</span>
                            </div>
                            <div class="team away">{{ $match['away'] }}</div>
                            <div class="meta">
                                <span>{{ $match['group_label'] }}</span>
                                <span>{{ $match['venue'] }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Live Scores --}}
        <section class="api-section">
            <div class="section-header">
                <h2>আজকের ম্যাচ স্কোর</h2>
                <span class="live-badge" id="liveBadge" hidden><span class="pulse-dot"></span> লাইভ</span>
                <button class="refresh-btn" id="refreshResults" type="button">↻ রিফ্রেশ</button>
            </div>
            <div id="resultsContainer">
                <div class="loading-skeleton">স্কোর লোড হচ্ছে…</div>
            </div>
        </section>

        {{-- Points Table --}}
        <section class="api-section">
            <div class="section-header">
                <h2>পয়েন্ট টেবিল</h2>
            </div>
            <div id="standingsContainer">
                <div class="loading-skeleton">পয়েন্ট টেবিল লোড হচ্ছে…</div>
            </div>
        </section>

        <section>
            <div class="fixture-tools">
                <h2>সম্পূর্ণ ম্যাচ সূচি</h2>
                <button class="download-button" type="button" id="downloadFixture">Download Schedule PNG</button>
            </div>

            <div class="fixture-filters">
                <input id="fixtureSearch" type="search" placeholder="Search team, venue, match number">
                <select id="teamFilter">
                    <option value="">All countries</option>
                    @foreach ($fixtureTeams as $team)
                        <option value="{{ $team }}">{{ $team }}</option>
                    @endforeach
                </select>
                <select id="stageFilter">
                    <option value="">All stages</option>
                    @foreach ($fixtureStages as $stage)
                        <option value="{{ $stage }}">{{ $stage }}</option>
                    @endforeach
                </select>
                <select id="sortFilter">
                    <option value="asc">Date: earliest first</option>
                    <option value="desc">Date: latest first</option>
                </select>
                <button class="clear-button" type="button" id="clearFilters">Clear</button>
            </div>
            <p class="filter-status" id="fixtureFilterStatus"></p>

            <div class="fixture-poster" id="fixturePoster">
                <div class="fixture-head">
                    <div>
                        <p class="fixture-kicker">Bangladesh Time Schedule</p>
                        <h2 class="fixture-title">World Cup 2026 Match Schedule</h2>
                    </div>
                    <div class="fixture-total">
                        <span>Total Fixtures</span>
                        <strong>{{ $matchesByDate->sum(fn($group) => $group['matches']->count()) }}</strong>
                    </div>
                </div>

                <div class="fixture-dates">
                    @foreach ($matchesByDate as $group)
                        <article class="fixture-date-group" data-fixture-date-group
                            data-date="{{ $group['date']->format('Y-m-d') }}">
                            <div class="fixture-date">
                                <strong>{{ $group['date']->format('M d') }}</strong>
                                <span>{{ $group['date']->format('l, Y') }}</span>
                                <span>{{ $group['matches']->count() }}
                                    match{{ $group['matches']->count() > 1 ? 'es' : '' }}</span>
                            </div>
                            <div class="fixture-items">
                                @foreach ($group['matches'] as $match)
                                    <div class="fixture-item" data-fixture-item
                                        data-home="{{ Str::lower($match['home']) }}"
                                        data-away="{{ Str::lower($match['away']) }}"
                                        data-stage="{{ Str::lower($match['group_label']) }}"
                                        data-match-number="{{ $match['match_number'] }}"
                                        data-search="{{ Str::lower('M' . $match['match_number'] . ' ' . $match['time_label'] . ' ' . $match['home'] . ' ' . $match['away'] . ' ' . $match['group_label'] . ' ' . $match['venue']) }}">
                                        <div class="fixture-match-no">M{{ $match['match_number'] }}</div>
                                        <div class="fixture-time">{{ $match['time_label'] }}</div>
                                        <div class="fixture-teams">{{ $match['home'] }} vs {{ $match['away'] }}</div>
                                        <div class="fixture-meta">{{ $match['group_label'] }} / {{ $match['venue'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="fixture-footer">
                    <span>All kickoff times are shown in Bangladesh Standard Time.</span>
                    <span>Share-ready fixture picture for football fans.</span>
                </div>
            </div>
        </section>
    </main>

    <script>
        /* ── Live Scores & Standings ─────────────────────────────── */
        (function () {
            function bdtTime(utcStr) {
                const d = new Date(utcStr);
                const utcMs = d.getTime();
                const bdtMs = utcMs + 6 * 3600 * 1000;
                const b = new Date(bdtMs);
                const h = b.getUTCHours(), m = b.getUTCMinutes();
                const ampm = h >= 12 ? 'PM' : 'AM';
                const h12 = String(h % 12 || 12).padStart(2, '0');
                return `${h12}:${String(m).padStart(2, '0')} ${ampm}`;
            }

            const STATUS_LIVE = ['IN_PLAY', 'PAUSED', 'HALFTIME'];
            const STATUS_DONE = ['FINISHED', 'FULL_TIME', 'EXTRA_TIME', 'PENALTY_SHOOTOUT'];

            function statusBn(s, min) {
                if (s === 'IN_PLAY') return min ? `${min}'` : 'লাইভ';
                if (s === 'HALFTIME' || s === 'PAUSED') return 'বিরতি';
                if (STATUS_DONE.includes(s)) return 'শেষ';
                if (s === 'TIMED' || s === 'SCHEDULED') return 'নির্ধারিত';
                if (s === 'POSTPONED') return 'স্থগিত';
                if (s === 'CANCELLED') return 'বাতিল';
                return s;
            }

            function cardClass(s) {
                if (STATUS_LIVE.includes(s)) return 's-live';
                if (STATUS_DONE.includes(s)) return 's-finished';
                return 's-scheduled';
            }

            function scoreDisplay(match) {
                const s = match.score;
                const ft = s?.fullTime;
                if (ft && ft.home !== null) return `${ft.home} – ${ft.away}`;
                if (STATUS_LIVE.includes(match.status)) {
                    const ht = s?.halfTime;
                    return (ht && ht.home !== null) ? `${ht.home} – ${ht.away}` : '– –';
                }
                return 'vs';
            }

            function renderCard(m) {
                const home = m.homeTeam?.shortName || m.homeTeam?.name || '?';
                const away = m.awayTeam?.shortName || m.awayTeam?.name || '?';
                const group = m.group ? m.group.replace('GROUP_', 'গ্রুপ ') : (m.stage || '');
                const cls = cardClass(m.status);
                const score = scoreDisplay(m);
                const isLive = STATUS_LIVE.includes(m.status);
                return `
                <div class="result-card ${cls}">
                    <div class="result-header">
                        <span class="result-group">${group}</span>
                        <span class="result-status">${statusBn(m.status, m.minute)}</span>
                    </div>
                    <div class="result-teams">
                        <div class="result-team">${home}</div>
                        <div class="result-score-box">
                            <div class="result-score">${score}</div>
                            ${isLive ? '<div class="result-score-label">লাইভ স্কোর</div>' : ''}
                        </div>
                        <div class="result-team away">${away}</div>
                    </div>
                    <div class="result-footer">
                        <span>🕐 ${bdtTime(m.utcDate)} BDT</span>
                        <span>${(m.venue?.name || '').split(',')[0]}</span>
                    </div>
                </div>`;
            }

            async function loadResults() {
                const box = document.getElementById('resultsContainer');
                const badge = document.getElementById('liveBadge');
                if (!box) return;
                try {
                    const r = await fetch('/api/wc2026/results');
                    const j = await r.json();

                    if (!j.configured) {
                        box.innerHTML = `<div class="api-notice">
                            <h3>⚙️ API Key প্রয়োজন</h3>
                            <p>Live score দেখতে <a href="https://www.football-data.org/client/register" target="_blank" rel="noopener">football-data.org</a>-এ বিনামূল্যে রেজিস্ট্রেশন করে <code>.env</code> ফাইলে <code>FOOTBALL_API_KEY=আপনার_কী</code> যোগ করুন।</p>
                        </div>`;
                        return;
                    }

                    if (j.error) { box.innerHTML = '<p class="muted" style="padding:16px">API থেকে ডেটা আনতে সমস্যা হয়েছে।</p>'; return; }

                    const matches = j.data?.matches || [];
                    if (matches.length === 0) {
                        box.innerHTML = '<p class="muted" style="padding:16px">আজকের কোনো ম্যাচ স্কোর পাওয়া যায়নি।</p>';
                        return;
                    }

                    const hasLive = matches.some(m => STATUS_LIVE.includes(m.status));
                    if (badge) badge.hidden = !hasLive;
                    box.innerHTML = `<div class="result-grid">${matches.map(renderCard).join('')}</div>`;

                    if (hasLive) setTimeout(loadResults, 60000);
                } catch (e) {
                    box.innerHTML = '<p class="muted" style="padding:16px">রেজাল্ট লোড করতে সমস্যা হয়েছে।</p>';
                }
            }

            async function loadStandings() {
                const box = document.getElementById('standingsContainer');
                if (!box) return;
                try {
                    const r = await fetch('/api/wc2026/standings');
                    const j = await r.json();

                    if (!j.configured) {
                        box.innerHTML = `<div class="api-notice">
                            <h3>⚙️ API Key প্রয়োজন</h3>
                            <p><code>.env</code> ফাইলে <code>FOOTBALL_API_KEY</code> সেট করলে এখানে পয়েন্ট টেবিল দেখাবে।</p>
                        </div>`;
                        return;
                    }

                    if (j.error) { box.innerHTML = '<p class="muted" style="padding:16px">API থেকে ডেটা আনতে সমস্যা হয়েছে।</p>'; return; }

                    const groups = (j.data?.standings || []).filter(s => s.type === 'TOTAL');
                    if (groups.length === 0) {
                        box.innerHTML = '<p class="muted" style="padding:16px">পয়েন্ট টেবিল এখনো পাওয়া যায়নি।</p>';
                        return;
                    }

                    const tabs = groups.map((g, i) => {
                        const label = g.group ? g.group.replace('GROUP_', 'Group ') : `Group ${i + 1}`;
                        return `<button class="std-tab${i === 0 ? ' active' : ''}" data-idx="${i}">${label}</button>`;
                    }).join('');

                    const panels = groups.map((g, i) => {
                        const rows = (g.table || []).map(row => {
                            const p = row.position;
                            const pCls = p <= 2 ? `p${p}` : p === 3 ? 'p3' : 'p4';
                            const gd = row.goalDifference;
                            const gdStr = gd > 0 ? `<span class="gd-pos">+${gd}</span>` : gd < 0 ? `<span class="gd-neg">${gd}</span>` : gd;
                            const name = row.team?.shortName || row.team?.name || '?';
                            return `<tr>
                                <td><span class="pos-num ${pCls}">${p}</span></td>
                                <td class="team-cell">${name}</td>
                                <td>${row.playedGames}</td>
                                <td>${row.won}</td>
                                <td>${row.draw}</td>
                                <td>${row.lost}</td>
                                <td>${row.goalsFor}</td>
                                <td>${row.goalsAgainst}</td>
                                <td>${gdStr}</td>
                                <td class="pts-cell">${row.points}</td>
                            </tr>`;
                        }).join('');
                        return `<div class="std-panel${i === 0 ? ' active' : ''}" data-panel="${i}">
                            <table class="standings-table">
                                <thead><tr>
                                    <th>#</th><th>দল</th><th>ম্যাচ</th><th>জয়</th><th>ড্র</th><th>হার</th><th>GF</th><th>GA</th><th>GD</th><th>পয়েন্ট</th>
                                </tr></thead>
                                <tbody>${rows}</tbody>
                            </table>
                        </div>`;
                    }).join('');

                    box.innerHTML = `<div class="standings-tabs">${tabs}</div><div>${panels}</div>`;

                    box.querySelectorAll('.std-tab').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const idx = btn.dataset.idx;
                            box.querySelectorAll('.std-tab').forEach(b => b.classList.remove('active'));
                            box.querySelectorAll('.std-panel').forEach(p => p.classList.remove('active'));
                            btn.classList.add('active');
                            box.querySelector(`.std-panel[data-panel="${idx}"]`).classList.add('active');
                        });
                    });
                } catch (e) {
                    box.innerHTML = '<p class="muted" style="padding:16px">পয়েন্ট টেবিল লোড করতে সমস্যা হয়েছে।</p>';
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                loadResults();
                loadStandings();
                document.getElementById('refreshResults')?.addEventListener('click', loadResults);
            });
        })();

        window.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('downloadFixture');
            const poster = document.getElementById('fixturePoster');
            const searchInput = document.getElementById('fixtureSearch');
            const teamFilter = document.getElementById('teamFilter');
            const stageFilter = document.getElementById('stageFilter');
            const sortFilter = document.getElementById('sortFilter');
            const clearFilters = document.getElementById('clearFilters');
            const filterStatus = document.getElementById('fixtureFilterStatus');
            const fixtureDates = document.querySelector('.fixture-dates');
            const fixtureItems = [...document.querySelectorAll('[data-fixture-item]')];
            const dateGroups = [...document.querySelectorAll('[data-fixture-date-group]')];
            const totalFixtures = fixtureItems.length;

            const normalize = (value) => (value || '').trim().toLowerCase();
            const applyFixtureSort = () => {
                const direction = sortFilter?.value === 'desc' ? 'desc' : 'asc';
                const multiplier = direction === 'desc' ? -1 : 1;

                dateGroups
                    .sort((a, b) => multiplier * (a.dataset.date || '').localeCompare(b.dataset.date || ''))
                    .forEach((group) => {
                        const itemsWrap = group.querySelector('.fixture-items');
                        [...group.querySelectorAll('[data-fixture-item]')]
                        .sort((a, b) => multiplier * (Number(a.dataset.matchNumber) - Number(b.dataset
                                .matchNumber)))
                            .forEach((item) => itemsWrap?.append(item));
                        fixtureDates?.append(group);
                    });
            };
            const applyFixtureFilters = () => {
                const query = normalize(searchInput?.value);
                const team = normalize(teamFilter?.value);
                const stage = normalize(stageFilter?.value);
                let visibleCount = 0;

                fixtureItems.forEach((item) => {
                    const searchText = item.dataset.search || '';
                    const matchesSearch = !query || searchText.includes(query);
                    const matchesTeam = !team || item.dataset.home === team || item.dataset.away ===
                        team;
                    const matchesStage = !stage || item.dataset.stage === stage;
                    const isVisible = matchesSearch && matchesTeam && matchesStage;

                    item.hidden = !isVisible;
                    if (isVisible) visibleCount++;
                });

                dateGroups.forEach((group) => {
                    group.hidden = !group.querySelector('[data-fixture-item]:not([hidden])');
                });

                if (filterStatus) {
                    filterStatus.textContent = `${visibleCount} of ${totalFixtures} fixtures showing`;
                }
            };

            const updateFixtures = () => {
                applyFixtureSort();
                applyFixtureFilters();
            };

            [searchInput, teamFilter, stageFilter, sortFilter].forEach((control) => {
                control?.addEventListener('input', updateFixtures);
                control?.addEventListener('change', updateFixtures);
            });

            clearFilters?.addEventListener('click', () => {
                if (searchInput) searchInput.value = '';
                if (teamFilter) teamFilter.value = '';
                if (stageFilter) stageFilter.value = '';
                if (sortFilter) sortFilter.value = 'asc';
                updateFixtures();
            });

            button?.addEventListener('click', async () => {
                if (!window.html2canvas || !poster) return;

                const canvas = await html2canvas(poster, {
                    scale: 2,
                    backgroundColor: null,
                    useCORS: true,
                });
                const link = document.createElement('a');
                link.download = `world-cup-2026-fixtures-${Date.now()}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
            });

            updateFixtures();
        });

        /* ── BDT Live Clock ── */
        (function () {
            const clockEl = document.getElementById('bdtClock');
            const dateEl  = document.getElementById('bdtDate');
            if (!clockEl) return;
            const days = ['রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার','শনিবার'];
            function tick() {
                const now = new Date(Date.now() + 6 * 3600000);
                const h = String(now.getUTCHours()).padStart(2, '0');
                const m = String(now.getUTCMinutes()).padStart(2, '0');
                const s = String(now.getUTCSeconds()).padStart(2, '0');
                clockEl.textContent = `${h}:${m}:${s}`;
                if (dateEl) {
                    const day = days[now.getUTCDay()];
                    const date = now.toUTCString().slice(5, 16);
                    dateEl.textContent = `${day}, ${date}`;
                }
            }
            tick();
            setInterval(tick, 1000);
        })();
    </script>
</body>

</html>
