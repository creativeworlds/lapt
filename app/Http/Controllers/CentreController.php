<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Enums\PreferredSeller;
use App\Enums\TaxType;
use App\Http\Requests\CentreRequest;
use App\Models\Centre;
use App\Models\CentreCategory;
use App\Models\Country;
use App\Enums\CentreType;

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
        $centreCategories = CentreCategory::all();
        $countries = Country::get(['id', 'name']);
        $centreTypes = CentreType::cases();
        $currencies = Currency::cases();
        $taxTypes = TaxType::cases();
        $preferredSellers = PreferredSeller::cases();
        return view('centres.create', compact(['centreCategories', 'countries', 'centreTypes', 'currencies', 'taxTypes', 'preferredSellers']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CentreRequest $req)
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
    public function update(CentreRequest $req, Centre $centre)
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

    public function getCentreCourses(Centre $centre)
    {
        return $centre->courses;
    }
}