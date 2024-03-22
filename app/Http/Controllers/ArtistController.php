<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();
        return view('pages.artists.index', compact('artists'));
    }

    public function lps($slug)
    {
        $artist = Artist::where('slug', $slug)->firstOrFail();
        $artist_name = $artist->name;
        $lps = $artist->lps;
        return view('pages.artists.lps', compact('artist_name', 'lps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArtistRequest $request)
    {
        $artist = new Artist();
        $artist->slug = Str::slug($request->input('name'));
        $artist->name = $request->input('name');
        $artist->description = $request->input('description');
        $artist->save();

        return response()->json(['message' => 'Artist created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        $artist = Artist::where('slug', $slug)->firstOrFail();
        return view('pages.artists.show', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArtistRequest $request, string $id)
    {
        $artist = Artist::find($id);
        $artist->name = $request->name;
        $artist->description = $request->description;
        $artist->save();

        return response()->json(['message' => 'Artist updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artist = Artist::find($id);
        $artist->delete();

        return response()->json(['message' => 'Artist deleted successfully.']);
    }
}
