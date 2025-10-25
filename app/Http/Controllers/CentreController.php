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
        $totalCentres = Centre::count();
        $centreTypes = CentreType::cases();
        return view('centres.index', compact(['centres', 'totalCentres', 'centreTypes']));
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

        return view('centres.create', compact('centreCategories', 'countries', 'centreTypes', 'currencies', 'taxTypes', 'preferredSellers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CentreRequest $req)
    {
        // Initialize optional paths
        $chairman_sign = $examiner_sign = $logo = null;

        // Upload chairman signature
        if ($req->hasFile('chairman_sign'))
            $chairman_sign = $req->chairman_sign->storeAs('centres', date('Y_m_d') . '_CHM_' . $req->chairman_sign->getClientOriginalName(), 'public');

        // Upload examiner signature
        if ($req->hasFile('examiner_sign'))
            $examiner_sign = $req->examiner_sign->storeAs('centres', date('Y_m_d') . '_EXM_' . $req->examiner_sign->getClientOriginalName(), 'public');

        // Upload center logo
        if ($req->hasFile('logo'))
            $logo = $req->logo->storeAs('centres', date('Y_m_d') . '_LOGO_' . $req->logo->getClientOriginalName(), 'public');

        // Create centre record
        Centre::create([...$req->all(), ...compact(['chairman_sign', 'examiner_sign', 'logo'])]);

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
        $centreCategories = CentreCategory::all();
        $countries = Country::get(['id', 'name']);
        $centreTypes = CentreType::cases();
        $currencies = Currency::cases();
        $taxTypes = TaxType::cases();
        $preferredSellers = PreferredSeller::cases();

        return view('centres.edit', compact('centreCategories', 'countries', 'centreTypes', 'currencies', 'taxTypes', 'preferredSellers', 'centre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CentreRequest $req, Centre $centre)
    {
        // Upload chairman signature
        if ($req->hasFile('chairman_sign'))
            $chairman_sign = $req->chairman_sign->storeAs('centres', date('Y_m_d') . '_CHM_' . $req->chairman_sign->getClientOriginalName(), 'public');

        // Upload examiner signature
        if ($req->hasFile('examiner_sign'))
            $examiner_sign = $req->examiner_sign->storeAs('centres', date('Y_m_d') . '_EXM_' . $req->examiner_sign->getClientOriginalName(), 'public');

        // Upload center logo
        if ($req->hasFile('logo'))
            $logo = $req->logo->storeAs('centres', date('Y_m_d') . '_LOGO_' . $req->logo->getClientOriginalName(), 'public');

        // Create centre record
        $centre->update([...$req->all(), ...compact(['chairman_sign', 'examiner_sign', 'logo'])]);

        return back()->with('message', 'Centre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Centre $centre)
    {
        $centre->delete();
        return back()->with('error', 'Centre deleted successfully.');
    }

    public function getCentreCourses(Centre $centre)
    {
        return $centre->courses;
    }
}