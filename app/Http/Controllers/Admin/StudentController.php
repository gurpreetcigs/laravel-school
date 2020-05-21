<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\{ User, Standard };
use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::paginate(5);
        $today = Carbon::now();
        return view('admin.student.list', compact('students', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standards = Standard::all();
        return view('admin.student.add', compact('standards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'standard_id' => 'required'
        ]);

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'standard_id' => $data['standard_id'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('student');

        $url = route('admin.student.index');
        return redirect($url)->with('status', 'Student added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $standards = Standard::all();
        $student = User::findorFail($id);
        return view('admin.student.edit', compact('student', 'standards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $data = $request->all();
        
        $user = User::findorFail($id);

        $user->fill($data);

        $user->save();

        $url = route('admin.student.index');
        return redirect($url)->with('status', 'Student Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = User::findorFail($id);
        $student->delete();
        $url = route('admin.student.index');
        return redirect($url)->with('status', 'Student Deleted successfully!');
    }

    /**
     * Show Activate Page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewActivatePage($id){
        $standards = Standard::all();
        $student = User::findorFail($id);
        return view('admin.student.active', compact('student', 'standards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|max:255|unique:users',
            'standard_id' => 'required'
        ]);

        $data = $request->all();
        
        $user = User::findorFail($id);

        $user->username = $data['username'];

        $user->expires_at = Carbon::now()->addYear();

        $user->standard_id = $data['standard_id'];

        $user->save();

        $url = route('admin.student.index');
        return redirect($url)->with('status', 'Student Activated successfully!');
    }
}
