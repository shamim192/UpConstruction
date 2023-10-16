<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SecondServiceLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\SecondServiceLink;
use Illuminate\Http\Request;

class SecondServiceLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SecondServiceLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.second-service-link.index');
    }

   /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.second-service-link.create');
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

        SecondServiceLink::create($storeData);


        toastr()->success('Second Service Link Created Successfully!', 'Success');
        return redirect()->route('admin.second-service-link.index');
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
        $serviceLink = SecondServiceLink::findOrFail($id);
       
        return view('admin.second-service-link.edit',compact('serviceLink'));
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



        $serviceLink = SecondServiceLink::findOrFail($id);


        $storeData = [

            'name' => $request->name,
            'url' => $request->url,

        ];
        $serviceLink->update($storeData);

        toastr()->success('Second Service Link Updated Successfully!', 'Success');
        return redirect()->route('admin.second-service-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceLink = SecondServiceLink::findOrFail($id);
        $serviceLink->delete();
    }
}
