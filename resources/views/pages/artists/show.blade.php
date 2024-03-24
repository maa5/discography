@extends('layouts.app')

@section('title', $artist->name)

@section('content')
    <a class="link-back" href="{{ route('artists.index') }}"><i class="fas fa-chevron-left"></i> Back to Artists</a>

    <div class='container-artist'>
        <div class='head-artist'>
            <h2>Artist: {{ $artist->name }}</h2>
            <div>
                <strong>Total LPs: {{ $artist->lps->count() }} </strong>
                (<a href="{{ route('artists.lps', $artist->slug) }}">View LPs</a>)
            </div>
        </div>
        <div class='description-artist'>
            <p>{{ $artist->description }}</p>
        </div>
    </div>
@endsection
