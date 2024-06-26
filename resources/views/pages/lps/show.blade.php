@extends('layouts.app')

@section('title', $lp->name)

@section('content')
    <a class="link-back" href="{{ route('lps.index') }}"><i class="fas fa-chevron-left"></i> Back to LPs</a>

    <div class='container-album'>
        <div class='head-lp'>
            <h2>LP: {{ $lp->name }}</h2>
            <strong>Artist: {{ $lp->artist->name }}</strong>
        </div>
        <div class='description-lp'>
            <p>{{ $lp->description }}</p>
        </div>
        <div class='list-songs-lp'>
            <strong>List of Songs:</strong>
            <ol>
                @foreach ($lp->songs as $song)
                    <li>"{{ $song->title }}" by {{ $song->authors->pluck('name')->implode(', ') }}</li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
