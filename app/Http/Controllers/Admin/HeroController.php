<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero = Hero::first();
        return view('admin.hero.index',compact('hero'));
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
            'btn_text' => ['required', 'max:200'],
            'images.*' => ['mimes:jpeg,jpg,png,gif|max:3000'],
        ]);
    
        
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = rand() . $image->getClientOriginalName();
                $image->move(public_path('/uploads'), $imageName);
                $images[] = "/uploads/" . $imageName;
            }
        
            $hero = Hero::first();
            if ($hero && isset($hero->images)) {
                $existingImages = json_decode($hero->images, true);
                foreach ($existingImages as $existingImage) {
                    if (File::exists(public_path($existingImage))) {
                        File::delete(public_path($existingImage));
                    }
                }
            }
        }

    
         Hero::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'btn_text' => $request->btn_text,
                'images' => isset($images) ? json_encode($images) : null,
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
