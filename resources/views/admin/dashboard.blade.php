@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <section class="grid">
        <div class="stat">Total Countries <b>{{ $totalCountries }}</b></div>
        <div class="stat">Total Users <b>{{ $totalUsers }}</b></div>
        <div class="stat">Total Downloads <b>{{ $totalDownloads }}</b></div>
        <div class="stat">Today Downloads <b>{{ $todayDownloads }}</b></div>
    </section>
    <section class="panel">
        <h2>Top Country</h2>
        <p>{{ $topCountry?->country?->name ?? 'No downloads yet' }} {{ $topCountry ? '(' . $topCountry->total . ')' : '' }}</p>
    </section>
    <section class="panel">
        <h2>Country-wise Chart</h2>
        <table><thead><tr><th>Country</th><th>Total</th></tr></thead><tbody>
            @foreach ($countryTotals as $row)<tr><td>{{ $row->country?->name }}</td><td>{{ $row->total }}</td></tr>@endforeach
        </tbody></table>
    </section>
@endsection
