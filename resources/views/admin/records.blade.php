@extends('admin.layout')
@section('title', 'Placard Records')
@section('content')
    <section class="panel">
        <h2>Filters</h2>
        <form class="filters" method="get">
            <select name="country_id"><option value="">Country</option>@foreach($countries as $country)<option value="{{ $country->id }}" @selected(request('country_id') == $country->id)>{{ $country->name }}</option>@endforeach</select>
            <select name="world_cup_year_id"><option value="">Year</option>@foreach($years as $year)<option value="{{ $year->id }}" @selected(request('world_cup_year_id') == $year->id)>{{ $year->year }}</option>@endforeach</select>
            <input name="phone" value="{{ request('phone') }}" placeholder="Phone">
            <input name="date" type="date" value="{{ request('date') }}">
            <button type="submit">Filter</button>
        </form>
    </section>
    <section class="panel">
        <h2>Download Records</h2>
        <table><thead><tr><th>Name</th><th>Phone</th><th>Country</th><th>Year</th><th>Count</th><th>Created</th><th>IP</th></tr></thead><tbody>
            @foreach ($records as $record)
                <tr><td>{{ $record->name }}</td><td>{{ $record->phone }}</td><td>{{ $record->country?->name }}</td><td>{{ $record->year?->year }}</td><td>{{ $record->download_count }}</td><td>{{ $record->created_at?->format('Y-m-d H:i') }}</td><td>{{ $record->ip_address }}</td></tr>
            @endforeach
        </tbody></table>
        {{ $records->links() }}
    </section>
@endsection
