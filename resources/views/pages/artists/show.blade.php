@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <div class='container-artist'>
        <a href="{{ route('artists.index') }}"><i class="fas fa-chevron-left"></i> Back to Artists</a>
        <div class='head-artist'>
            <h2>{{ $artist->name }}</h2>
            <strong>Total LPs: {{ $artist->lps->count() }}</strong>
        </div>
        <div class='description-artist'>
            <p>{{ $artist->description }}</p>
            <a href="{{ route('artists.lps', $artist->slug) }}">View LPs</a>
        </div>
    </div>
@endsection
