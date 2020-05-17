<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{Video, Subject, Standard};
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
        $standardId = request()->route('standard');
		$subjectName = Subject::find($subjectId);
        $videos = Video::where('subject_id', $subjectId)->paginate(5);
        return view('videos', compact('videos', 'subjectId', 'url', 'standardId', 'subjectName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectName = Subject::find(request()->route('id'));
        $standardId = request()->route('standard');
        return view('add-video', compact('subjectName', 'standardId'));
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
            'video' => 'file|size:500000|required|mimetypes:video/avi,video/mpeg,video/mp4'
        ]);

        $subjectId = request()->route('id');
        $standardId = request()->route('standard');
        $standardName = Standard::findorFail($standardId)->name;
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
        $url = route('admin.videos.index', [ 'standard' => $standardId, 'id' => $subjectId]);
        return redirect($url)->with('status', 'Video uploaded successfully!');
    }


    /**
     * Show the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($standardId, $id, $videoId){
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
    public function destroy($standardId, $id, $videoId)
    {
        $video = Video::findorFail($videoId);        
        Storage::disk('s3')->delete($video->url);
        $video->delete();
        $subjectId = request()->route('id');
        $standardId = request()->route('standard');
        $url = route('admin.videos.index', [ 'standard' => $standardId, 'id' => $subjectId]);
        return redirect($url)->with('status', 'Video deleted successfully!');
    }
}

