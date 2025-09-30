<?php

namespace App\Http\Controllers;

use App\Models\Centre;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centres = Centre::all();
        return view('centres.index', compact('centres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('centres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        Centre::create($req->all());
        return back()->with('message', 'Centre created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Centre $centre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Centre $centre)
    {
        return view('centres.edit', compact('centre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Centre $centre)
    {
        $centre->update($req->all());
        return back()->with('message', 'Centre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Centre $centre)
    {
        $centre->delete();
        return back()->with('message', 'Centre deleted successfully.');
    }
}