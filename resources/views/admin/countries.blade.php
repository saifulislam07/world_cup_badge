@extends('admin.layout')
@section('title', 'Countries')
@section('content')
    <section class="panel">
        <h2>Save Country</h2>
        <form method="post" action="{{ route('admin.countries.store') }}">
            @csrf
            <label>Name</label><input name="name" required>
            <label>Country Code</label><input name="code" placeholder="ar">
            <label>Flag URL</label><input name="flag" placeholder="https://flagcdn.com/w160/ar.png">
            <label>Sorting Order</label><input name="sort_order" type="number" min="0" value="0">
            <label class="inline"><input name="status" type="checkbox" value="1" checked> Active</label>
            <button type="submit">Save Country</button>
        </form>
    </section>
    <section class="panel">
        <h2>Countries</h2>
        <table><thead><tr><th>Name</th><th>Code</th><th>Flag</th><th>Status</th><th>Sort</th></tr></thead><tbody>
            @foreach ($countries as $country)<tr><td>{{ $country->name }}</td><td>{{ $country->code }}</td><td>{{ $country->flag }}</td><td>{{ $country->status ? 'Active' : 'Inactive' }}</td><td>{{ $country->sort_order }}</td></tr>@endforeach
        </tbody></table>
    </section>
@endsection
