<?php

namespace App\Http\Controllers;

use App\Http\Requests\CentreCategoryRequest;
use App\Models\CentreCategory;

class CentreCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('centres.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CentreCategoryRequest $req)
    {
        CentreCategory::create($req->all());
        return back()->with('message', 'Centre category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CentreCategory $centreCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentreCategory $centreCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CentreCategoryRequest $request, CentreCategory $centreCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentreCategory $centreCategory)
    {
        //
    }
}