@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container-home">
        <h1>Welcome to myDiscography</h1>
        <div class='list-options-home'>
            @component('_components.card')
                @slot('title', 'Artists')
                @slot('url', route('artists.index'))
                @slot('image', asset('assets/img/guitar-756326_640.jpg'))
            @endcomponent
            @component('_components.card')
                @slot('title', 'LPs')
                @slot('url', route('lps.index'))
                @slot('image', asset('assets/img/plate-4725349_640.jpg'))
            @endcomponent
            @component('_components.card')
                @slot('title', 'Report')
                @slot('url', route('report.index'))
                @slot('image', asset('assets/img/turntable-1109588_640.jpg'))
            @endcomponent
        </div>
    </div>
@endsection
