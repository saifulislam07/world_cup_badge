<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Country Ranking</title>
    <style>
        :root {
            --ink: #101828;
            --muted: #667085;
            --line: #d0d5dd;
            --green: #007a3d;
            --deep: #063d2a;
            --blue: #005eb8;
            --gold: #ffb703;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(180deg, #fff, #f6f8fb);
            color: var(--ink);
        }

        header {
            min-height: 178px;
            padding: 28px 5vw;
            display: grid;
            align-items: end;
            color: #fff;
            background: linear-gradient(135deg, var(--deep), var(--blue));
        }

        .topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .brand {
            font-weight: 950;
        }

        a {
            color: inherit;
            font-weight: 900;
            text-decoration: none;
        }

        .button {
            border-radius: 999px;
            padding: 10px 15px;
            color: var(--ink);
            background: var(--gold);
        }

        h1 {
            margin: 0;
            font-size: clamp(32px, 5vw, 54px);
            line-height: 1;
        }

        main {
            width: min(980px, 92vw);
            margin: -28px auto 36px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 22px 44px rgba(16, 24, 40, .1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            text-align: left;
        }

        th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
        }

        tr:hover td {
            background: #f9fafb;
        }

        img {
            width: 40px;
            height: 27px;
            object-fit: cover;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            border: 1px solid var(--line);
            border-radius: 3px;
        }

        .rank {
            width: 66px;
            font-weight: 950;
            color: var(--green);
        }
    </style>
</head>

<body>
    <header>
        <div>
            <div class="topline">
                <div class="brand">World Cup 2026 Badge Maker</div>
                <a class="button" href="{{ route('home') }}">Back to Generator</a>
            </div>

        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Country</th>
                    <th>Total Placards</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ranking as $row)
                    <tr>
                        <td class="rank">#{{ $loop->iteration }}</td>
                        <td>
                            @if ($row->country?->flag)
                                <img src="{{ $row->country->flag }}" alt="">
                            @endif{{ $row->country?->name }}
                        </td>
                        <td>{{ $row->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No downloads yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

</html>
