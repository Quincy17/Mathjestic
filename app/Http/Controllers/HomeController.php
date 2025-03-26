<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogModel; // Import the BlogModel class

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = BlogModel::latest()->take(3)->get(); // Ambil 3 blog terbaru
        return view('home', compact('blogs'));
    }
}
