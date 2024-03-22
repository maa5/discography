@extends('layouts.app')

@section('title', 'Report')

@section('content')
    <div class="container-table">
        <h1>Report</h1>
        <table id="reportTable" class="table datatable">
            <thead>
                <tr>
                    <th>LP</th>
                    <th>Artist</th>
                    <th>Nº Songs</th>
                    <th>Authors</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lps as $lp)
                    <tr>
                        <td>{{ $lp['lp_name'] }}</td>
                        <td>{{ $lp['artist_name'] }}</td>
                        <td style="text-align: center;">{{ $lp['num_songs'] }}</td>
                        <td>{{ $lp['list_authros'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            manageReport.init();
        });
    </script>
@endpush('js')
