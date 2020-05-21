<?php

namespace App\Http\Controllers\School;

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
        $videos = Video::where('subject_id', $subjectId)->paginate(5);
        return view('videos', compact('videos', 'subjectId', 'url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectName = Subject::find(request()->route('id'));
        return view('add-video', compact('subjectName'));
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
            'title' => 'required',
            'description' => 'required',
            'uploaded_by' => 'required',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4|max:500000'
        ]);
        $standardName = auth()->guard('school')->user()->standard()->name;
        $subjectId = request()->route('id');
        $subjectName = Subject::find($subjectId)->name;
        
        $filePath = "";
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'videos/' . $standardName. '/' . $subjectName . '/' .$name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $video = new Video;
            $video->fill($request->all());
            $video->subject_id = $subjectId;
            $video->url = $filePath;
            $video->save();
        }
        $url = route('school.videos.index', [ 'id' => $subjectId]);
        return redirect($url)->with('status', 'Video uploaded successfully!');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $videoId)
    {
        $video = Video::findorFail($videoId);        
        Storage::disk('s3')->delete($video->url);
        $video->delete();
        return back()->withSuccess('Video was deleted successfully');
    }
}
