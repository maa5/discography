<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\LP;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    // Method to fetch LPs data for DataTable
    public function lp(): JsonResponse
    {
        $lps = LP::orderBy('created_at', 'desc')->with('artist')->get();

        return datatables()->of($lps)->addColumn('url', function ($lp) {
            return route('lps.show', $lp->slug);
        })->toJson();
    }

    // Method to fetch Artists data for DataTable
    public function artist(): JsonResponse
    {
        $artists = Artist::orderBy('created_at', 'desc')->get();

        return datatables()->of($artists)->addColumn('url', function ($artist) {
            return route('artists.show', $artist->slug);
        })->toJson();
    }
}
