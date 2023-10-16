<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SocialLinkDataTable;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SocialLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.social-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'url' => 'required|url',
        ]);


        $storeData = [

            'icon' => $request->icon,
            'url' => $request->url,

        ];

        SocialLink::create($storeData);


        toastr()->success('Social Link Created Successfully!', 'Success');
        return redirect()->route('admin.social-link.index');
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
        $socialLink = SocialLink::findOrFail($id);

        return view('admin.social-link.edit', compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'required',
            'url' => 'required|url',
        ]);




        $socialLink = SocialLink::findOrFail($id);

        $storeData = [

            'icon' => $request->icon,
            'url' => $request->url,

        ];
        $socialLink->update($storeData);

        toastr()->success('Social Link Updated Successfully!', 'Success');
        return redirect()->route('admin.social-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();
    }
}
