<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Country Ranking</title>
    <style>
        body { margin: 0; font-family: Inter, ui-sans-serif, system-ui, sans-serif; background: #f5f8fb; color: #14213d; }
        main { width: min(980px, 92vw); margin: 36px auto; background: #fff; border: 1px solid #d9e2ec; border-radius: 8px; padding: 20px; }
        a { color: #167c54; font-weight: 800; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 13px; border-bottom: 1px solid #d9e2ec; text-align: left; }
        img { width: 40px; height: 27px; object-fit: cover; display: inline-block; vertical-align: middle; margin-right: 10px; border: 1px solid #d9e2ec; }
    </style>
</head>
<body>
    <main>
        <a href="{{ route('home') }}">Back to generator</a>
        <h1>Country Ranking</h1>
        <table>
            <thead><tr><th>Rank</th><th>Country</th><th>Total Placards</th></tr></thead>
            <tbody>
            @forelse ($ranking as $row)
                <tr><td>{{ $loop->iteration }}</td><td>@if($row->country?->flag)<img src="{{ $row->country->flag }}" alt="">@endif{{ $row->country?->name }}</td><td>{{ $row->total }}</td></tr>
            @empty
                <tr><td colspan="3">No downloads yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
