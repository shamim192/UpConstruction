<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AltServiceSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AltServiceSectionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $altService = AltServiceSetting::first(); 
        return view('admin.alt-service-setting.index',compact('altService'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'max:200'],
            'sub_title' => ['required', 'max:500'],
            'image' => ['max:3000','image'],           
        ]);

        $altService =AltServiceSetting::first();
        if($request->hasFile('image')){           
           if($altService && File::exists(public_path($altService->image))){
               File::delete(public_path($altService->image));
           }
           $image = $request->file('image');
           $imageName = rand().$image->getClientOriginalName();
           $image->move(public_path('/uploads'), $imageName);

           $imagePath = "/uploads/".$imageName;            
        }

        AltServiceSetting::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'image' => isset($imagePath) ? $imagePath: $altService->image,            
            ]
        );
    
        toastr()->success('Updated Successfully!', 'Congrats');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
