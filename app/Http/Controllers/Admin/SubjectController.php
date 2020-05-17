<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{ Standard, Subject};

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standardData = Standard::findorFail(request()->route('id'));
        return view('add-subject', compact('standardData'));
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
            'subject' => 'required',
        ]);
        $standard = request()->route('id');
        $subject = new Subject;
        $subject->name = $request->input('subject');
        $subject->standard_id = $standard;
        $subject->save();
        $url = route('admin.standard.show', [ 'standard' => $standard]);
        return redirect($url)->with('status', 'Subject added successfully!');
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
    public function destroy($id, $subjectId)
    {
        $subject = Subject::findorFail($subjectId);
        $subject->delete();
        $standard = request()->route('id');
        $url = route('admin.standard.show', ['standard' => $id]);
        return redirect($url)->with('status', 'Subject Deleted successfully!');
    }
}
