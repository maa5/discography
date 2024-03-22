@extends('layouts.app')

@section('title', $artist_name)

@section('content')
    <div class="container-lps-artist">
        <h1>LPs by {{ $artist_name }}</h1>
        <div class="list-lps-artist">
            @foreach ($lps as $lp)
                <div class="lp-card">
                    <div class="lp-card-body">
                        <h3>{{ $lp->name }}</h3>
                        <p>{{ $lp->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection