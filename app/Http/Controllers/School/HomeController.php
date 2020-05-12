<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    protected $redirectTo = '/school/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('school.auth:school');
    }

    /**
     * Show the School dashboard.
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
        $currentSchool = auth()->guard('school')->user();
        $subjects = $currentSchool->standard()->subjects()->get();
        $teacher = "{$currentSchool->name}";
        return view('subjects', compact('subjects', 'teacher'));
    }


}