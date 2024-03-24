@extends('layouts.app')

@section('title', $artist_name)

@section('content')
    <h1>LPs by {{ $artist_name }}</h1>

    <div class="container-lps-artist">
        <a class="link-back" href="{{ route('artists.show', $artist_slug) }}"><i class="fas fa-chevron-left"></i> Back to Artist</a>

        <div class="list-lps-artist">
            @if ($lps->isEmpty())
                <p>No LPs found for this artist.</p>
            @else
                @foreach ($lps as $lp)
                    <div class="lp-card">
                        <div class="lp-card-body">
                            <h3>{{ $lp->name }}</h3>
                            <p>{{ $lp->description }}</p>
                            <div>
                                <strong>List of Songs:</strong>
                                <ol>
                                    @foreach ($lp->songs as $song)
                                        <li>"{{ $song->title }}" by {{ $song->authors->pluck('name')->implode(', ') }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
