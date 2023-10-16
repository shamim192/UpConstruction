<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ThirdServiceLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\ThirdServiceLink;
use Illuminate\Http\Request;

class ThirdServiceLinkController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(ThirdServiceLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.third-service-link.index');
    }

   /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.third-service-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'url' => 'required|url',
        ]);


        $storeData = [

            'name' => $request->name,
            'url' => $request->url,

        ];

        ThirdServiceLink::create($storeData);


        toastr()->success('Third Service Link Created Successfully!', 'Success');
        return redirect()->route('admin.third-service-link.index');
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
        $serviceLink = ThirdServiceLink::findOrFail($id);
       
        return view('admin.third-service-link.edit',compact('serviceLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'name' => 'required|string',
            'url' => 'required|url',
        ]);



        $serviceLink = ThirdServiceLink::findOrFail($id);


        $storeData = [

            'name' => $request->name,
            'url' => $request->url,

        ];
        $serviceLink->update($storeData);

        toastr()->success('Third Service Link Updated Successfully!', 'Success');
        return redirect()->route('admin.third-service-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceLink = ThirdServiceLink::findOrFail($id);
        $serviceLink->delete();
    }
}
