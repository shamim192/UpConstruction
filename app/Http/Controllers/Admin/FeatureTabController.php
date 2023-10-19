<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeatureTabDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeatureTab;
use Illuminate\Http\Request;

class FeatureTabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeatureTabDataTable $dataTable)
    {
        return $dataTable->render('admin.feature-tab.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.feature-tab.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',   
        ]);

        $storeData = [
            'title' => $request->title,           
        ];

        FeatureTab::create($storeData);
        
        toastr()->success('Feature Tab Created Successfully!','Success');
        return redirect()->route('admin.feature-tab.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature =FeatureTab::findOrFail($id); 
        return view('admin.feature-tab.edit',compact('feature'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255', 
        ]);

        $feature = FeatureTab::findOrFail($id);

        $storeData = [
            'title' => $request->title,           
        ];

        $feature-> update($storeData);

        toastr()->success('Feature Tab Updated Successfully!','Success');
        return redirect()->route('admin.feature-tab.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature =FeatureTab::findOrFail($id);       
        $feature->delete();
    }
}
