<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{ Standard };

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standards = Standard::paginate(5);
        return view('standards', compact('standards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.standard.add');
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
            'value' => ['required', 'unique:standards'],
        ]);

        $data = $request->all();

        $standard = Standard::create([
            'name' => $data['name'],
            'value' => $data['value'],
        ]);

        $url = route('admin.standard.index');
        return redirect($url)->with('status', 'Standard added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentStandard = Standard::findorFail($id);
        $standardId = $currentStandard->id;
        $subjects = $currentStandard->subjects()->paginate(5);
        $teacher = $currentStandard->name;
        return view('subjects', compact('subjects', 'teacher', 'standardId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $standard = Standard::findorFail($id);
        $standard->delete();
        $url = route('admin.standard.index');
        return redirect($url)->with('status', 'Standard Deleted successfully!');
    }
}
