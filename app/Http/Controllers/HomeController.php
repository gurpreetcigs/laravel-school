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
        $this->middleware('auth');
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

    /**
     * Get the List of subjects.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSubjects(){
		$standardId = 0;
        $currentStudent = auth()->user();
        $subjects = $currentStudent->standard()->subjects()->paginate(5);
        $teacher = "{$currentStudent->name}";
        return view('subjects', compact('subjects', 'teacher', 'standardId'));
    }
}
