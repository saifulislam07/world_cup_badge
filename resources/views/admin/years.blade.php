@extends('admin.layout')
@section('title', 'Years')
@section('content')
    <section class="panel">
        <h2>Save Year</h2>
        <form method="post" action="{{ route('admin.years.store') }}">
            @csrf
            <label>Year</label><input name="year" required placeholder="2026">
            <label class="inline"><input name="is_default" type="checkbox" value="1"> Default</label>
            <label class="inline"><input name="status" type="checkbox" value="1" checked> Active</label>
            <button type="submit">Save Year</button>
        </form>
    </section>
    <section class="panel">
        <h2>Years</h2>
        <table><thead><tr><th>Year</th><th>Default</th><th>Status</th></tr></thead><tbody>
            @foreach ($years as $year)<tr><td>{{ $year->year }}</td><td>{{ $year->is_default ? 'Yes' : 'No' }}</td><td>{{ $year->status ? 'Active' : 'Inactive' }}</td></tr>@endforeach
        </tbody></table>
    </section>
@endsection
