<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

  public function quote(Request $request){
        
  }
}
