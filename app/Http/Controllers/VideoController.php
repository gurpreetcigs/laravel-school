<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{Video, Subject};
use Spatie\Permission\Models\Role;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/'; 
        $subjectId = request()->route('id');
        $videos = Video::where(['subject_id' => $subjectId, 'status' => '1'])->paginate(5);
        return view('videos', compact('videos', 'subjectId', 'url'));
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $videoId){
        // dd(auth()->guard('school')->user()->can('Read Video'));
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';;
        $video = Video::findorFail($videoId);
        return view('video', compact('video', 'url'));
    }
}
