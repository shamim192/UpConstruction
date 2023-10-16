<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ConstructionItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\ConstructionItem;
use Illuminate\Http\Request;

class ConstructionItemController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(ConstructionItemDataTable $dataTable)
    {
        return $dataTable->render('admin.construction-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view('admin.construction-item.create');
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

        ConstructionItem::create($storeData);

      
        toastr()->success('Contruction Created Successfully!','Success');
        return redirect()->route('admin.construction-item.index');
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
        $construction =ConstructionItem::findOrFail($id);        
        return view('admin.construction-item.edit',compact('construction'));
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

        $construction =ConstructionItem::findOrFail($id);
       
        if ($request->hasFile('image')) {            
            $imagePath = handleUpload('image');
            $construction->update(['image' => $imagePath]);
        }   
       
        $storeData = [           
            'title' => $request->title,
            'sub_title' => $request->sub_title,  
        ];
       
       $construction->update($storeData);

      
        toastr()->success('Construction Updated Successfully!','Success');
        return redirect()->route('admin.construction-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $construction =ConstructionItem::findOrFail($id);
        deleteFileIfExist($construction->image);
        $construction->delete();
    }
}
