<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeatureTabItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FeatureTabItem;
use Illuminate\Http\Request;

class FeatureTabItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeatureTabItemDataTable $dataTable)
    {
        return $dataTable->render('admin.feature-tab-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view('admin.feature-tab-item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            'title' => 'required|string|max:255',              
            'sub_title' => 'required|string|max:10000',
                    
        ]);

        $imagePath = handleUpload('image');

        $storeData = [
            'image' => $imagePath,
            'title' => $request->title,
            'sub_title' => $request->sub_title,           
            
        ];       

        FeatureTabItem::create($storeData);

      
        toastr()->success('Feature Tab Item Created Successfully!','Success');
        return redirect()->route('admin.feature-tab-item.index');
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
        $featureItem =FeatureTabItem::findOrFail($id);        
        return view('admin.feature-tab-item.edit',compact('featureItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5000',
            'title' => 'required|string|max:255',           
            'sub_title' => 'required|string|max:10000',           
            
        ]);

        $featureItem =FeatureTabItem::findOrFail($id);
       
        if ($request->hasFile('image')) {            
            $imagePath = handleUpload('image');
            $featureItem->update(['image' => $imagePath]);
        }   
       
        $storeData = [           
            'title' => $request->title,
            'sub_title' => $request->sub_title,  
        ];
       
       $featureItem->update($storeData);

      
        toastr()->success('Feature Item Updated Successfully!','Success');
        return redirect()->route('admin.feature-tab-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $featureItem =FeatureTabItem::findOrFail($id);
        deleteFileIfExist($featureItem->image);
        $featureItem->delete();
    }
}
