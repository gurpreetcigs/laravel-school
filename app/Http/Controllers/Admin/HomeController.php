<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{ Standard };

class HomeController extends Controller
{

    protected $redirectTo = '/admin/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('home');
    }

    /**
     * Get the List of subjects.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubjects(){
        $currentSchool = auth()->guard('admin')->user();
        $subjects = $currentSchool->standard()->subjects()->get();
        $teacher = "{$currentSchool->name}";
        return view('subjects', compact('subjects', 'teacher'));
    }

     /**
     * Get the List of standards.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getStandards(){
        $standards = Standard::all();
        return view('standards', compact('standards'));
    }

}