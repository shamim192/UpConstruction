<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\ServiceLink;
use Illuminate\Http\Request;

class ServiceLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.service-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service-link.create');
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

        ServiceLink::create($storeData);


        toastr()->success('service Link Created Successfully!', 'Success');
        return redirect()->route('admin.service-link.index');
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
        $serviceLink = ServiceLink::findOrFail($id);
       
        return view('admin.service-link.edit',compact('serviceLink'));
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



        $serviceLink = ServiceLink::findOrFail($id);


        $storeData = [

            'name' => $request->name,
            'url' => $request->url,

        ];
        $serviceLink->update($storeData);

        toastr()->success('Service Link Updated Successfully!', 'Success');
        return redirect()->route('admin.service-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $serviceLink = ServiceLink::findOrFail($id);
        $serviceLink->delete();
    }
}
