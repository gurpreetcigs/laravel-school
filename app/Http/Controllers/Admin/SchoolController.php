<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\{ School, Standard };

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::paginate(5);
        return view('admin.school.list', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standards = Standard::all();
        return view('admin.school.add', compact('standards'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:schools'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'standard_id' => 'required'
        ]);

        $data = $request->all();

        $user = School::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'standard_id' => $data['standard_id'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('school');

        $url = route('admin.school.index');
        return redirect($url)->with('status', 'School added successfully!');

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
        $school = School::findorFail($id);
        return view('admin.school.edit', compact('school', 'standards'));
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
        
        $school = School::findorFail($id);

        $school->fill($data);

        $school->save();

        $url = route('admin.school.index');
        return redirect($url)->with('status', 'School Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::findorFail($id);
        $school->delete();
        $url = route('admin.school.index');
        return redirect($url)->with('status', 'School Deleted successfully!');
    }
}

