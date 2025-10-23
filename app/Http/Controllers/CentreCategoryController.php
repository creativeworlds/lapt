<?php

namespace App\Http\Controllers;

use App\Http\Requests\CentreCategoryRequest;
use App\Models\CentreCategory;
use App\Models\UserActivityLog;

class CentreCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centreCategories = CentreCategory::all();
        $totalCentreCategories = CentreCategory::count();
        return view("centres.categories.index", compact(['centreCategories', 'totalCentreCategories']));
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
        // create centre category
        $centreCategory = CentreCategory::create($req->all());

        // user activity log create
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'module_name' => 'Centre Category',
            'action_type' => 'Add',
            'action_details' => 'Added a new centre category.',
            'old_value' => [],
            'new_value' => [
                'id' => $centreCategory->id,
                "name" => $req->name
            ]
        ]);

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
        // delete centre category
        $centreCategory->delete();

        // user activity log create
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'module_name' => 'Centre Category',
            'action_type' => 'Delete',
            'action_details' => 'Deleted a centre category.',
            'old_value' => [
                'id' => $centreCategory->id,
                "name" => $centreCategory->name
            ],
            'new_value' => []
        ]);

        return back()->with('error', 'Centre category deleted successfully.');
    }
}