@extends('layouts.app')

@section('title', 'LPs')

@section('content')
    <h1>LPs</h1>

    <div class="container-table">
        <form class="form-inline filter-form-table" role="form">
            <div class="form-group">
                <label for="artistFilter">Filter By Artist:&nbsp;&nbsp;</label>
                <select id="artistFilter" name="artist" class="form-control">
                    <option value="">All Artists</option>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->name }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <table id="lpsTable" class="table datatable">
            <thead>
                <tr>
                    <th>LP</th>
                    <th>Artist</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>

    @include('pages.lps.partials.lp_modal_form')

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            manageLP.init("{{ route('datatable.lp') }}");
        });
    </script>
@endpush
