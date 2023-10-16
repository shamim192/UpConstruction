<?php

namespace App\Http\Controllers\Admin;

use App\Models\UsefulLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UsefulLinkDataTable;

class UsefulLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsefulLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.useful-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.useful-link.create');
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

        UsefulLink::create($storeData);


        toastr()->success('Useful Link Created Successfully!', 'Success');
        return redirect()->route('admin.useful-link.index');
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
         $usefulLink = UsefulLink::findOrFail($id);
       
        return view('admin.useful-link.edit',compact('usefulLink'));
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



        $usefulLink = UsefulLink::findOrFail($id);


        $storeData = [

            'name' => $request->name,
            'url' => $request->url,

        ];
        $usefulLink->update($storeData);

        toastr()->success('Useful Link Updated Successfully!', 'Success');
        return redirect()->route('admin.useful-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $usefulLink = UsefulLink::findOrFail($id);
        $usefulLink->delete();
    }
}
