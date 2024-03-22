<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\LP;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $listLPS = LP::all();

        $lps = [];

        foreach ($listLPS as $lp) {
            $authors = $lp->songs->flatMap(function ($song) {
                return $song->authors->pluck('name');
            })->implode(', ');

            $lps[] = [
                'id_lp' => $lp->id,
                'lp_name' => $lp->name,
                'artist_name' => $lp->artist->name,
                'num_songs' => $lp->songs->count(),
                'list_authros' => $authors
            ];
        }

        return view('pages.report.index', compact('lps'));
    }
}
