<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AltServiceItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\AltServiceItem;
use Illuminate\Http\Request;

class AltServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AltServiceItemDataTable $dataTable)
    {
        return $dataTable->render('admin.alt-service-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.alt-service-item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',              
            'sub_title' => 'required|string|max:10000',
        ]);

        $storeData = [
            'title' => $request->title,
            'sub_title' => $request->sub_title, 
        ];

        AltServiceItem::create($storeData);
        
        toastr()->success('Alt Service Item Created Successfully!','Success');
        return redirect()->route('admin.alt-service-item.index');
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
        $altServiceItem =AltServiceItem::findOrFail($id); 
        return view('admin.alt-service-item.edit',compact('altServiceItem'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',              
            'sub_title' => 'required|string|max:10000',
        ]);

        $altServiceItem = AltServiceItem::findOrFail($id);

        $storeData = [
            'title' => $request->title,
            'sub_title' => $request->sub_title, 
        ];

        $altServiceItem-> update($storeData);

        toastr()->success('Alt Service Item Updated Successfully!','Success');
        return redirect()->route('admin.alt-service-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $altServiceItem =AltServiceItem::findOrFail($id);       
        $altServiceItem->delete();
    }
}
