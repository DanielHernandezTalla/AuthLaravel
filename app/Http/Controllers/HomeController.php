<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('can:home')->only('index');
        $this->middleware('can:admin')->only('admin');
        $this->middleware('can:manager')->only('manager');
        $this->middleware('can:developer')->only('developer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin');
    }

    public function manager()
    {
        return view('manager');
    }

    public function developer()
    {
        return view('developer');
    }
}
