<?php

namespace App\Http\Controllers;

use App\Http\Requests\LPRequest;
use App\Models\Artist;
use App\Models\LP;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class LPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();
        return view('pages.lps.index', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LPRequest $request)
    {
        $lp = new LP();
        $lp->slug = Str::slug($request->name);
        $lp->name = $request->name;
        $lp->description = $request->description;
        $lp->artist_id = $request->artist;
        $lp->save();

        return response()->json(['message' => 'LP created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        $lp = LP::where('slug', $slug)->firstOrFail();
        return view('pages.lps.show', compact('lp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LPRequest $request, string $id)
    {
        $lp = LP::find($id);
        $lp->name = $request->name;
        $lp->description = $request->description;
        $lp->artist_id = $request->artist;
        $lp->save();

        return response()->json(['message' => 'LP updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lp = LP::find($id);
        $lp->delete();

        return response()->json(['message' => 'LP deleted successfully.']);
    }
}
