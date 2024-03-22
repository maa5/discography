@extends('layouts.app')

@section('title', 'Artists')

@section('content')
    <div class="container-table">
        <h1>Artists</h1>
        <table id="artistsTable" class="table datatable">
            <thead>
                <tr>
                    <th>Artist</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>

    @include('pages.artists.partials.artist_modal_form')

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            manageArtist.init("{{ route('datatable.artist') }}");
        });
    </script>
@endpush
