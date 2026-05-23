@extends('admin.layout')
@section('title', 'Settings')
@section('content')
    <section class="panel">
        <h2>Site Settings</h2>
        <form method="post" action="{{ route('admin.settings.store') }}">
            @csrf
            @foreach (['website_name','footer_text','copyright_text','meta_title','meta_description','meta_keywords','open_graph_image'] as $key)
                <label>{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                <input name="{{ $key }}" value="{{ $settings[$key] ?? '' }}" @if($key === 'website_name') required @endif>
            @endforeach
            <button type="submit">Save Settings</button>
        </form>
    </section>
@endsection
