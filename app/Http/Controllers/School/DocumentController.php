<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{Document, Subject};
use Spatie\Permission\Models\Role;

class DocumentController extends Controller
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
		$subjectName = Subject::find($subjectId);
        $documents = Document::where('subject_id', $subjectId)->paginate(5);
        return view('documents', compact('documents', 'subjectId', 'url', 'subjectName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjectName = Subject::find(request()->route('id'));
        return view('add-document', compact('subjectName'));
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
            'uploaded_by' => 'required',
            'document' => 'required|max:500000'
        ]);
        $standardName = auth()->guard('school')->user()->standard()->name;
        $subjectId = request()->route('id');
        $subjectName = Subject::find($subjectId)->name;
        
        $filePath = "";
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'document/' . $standardName. '/' . $subjectName . '/' .$name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $document = new Document;
            $document->fill($request->all());
            $document->subject_id = $subjectId;
            $document->url = $filePath;
            $document->save();
        }
        $url = route('school.documents.index', [ 'id' => $subjectId]);
        return redirect($url)->with('status', 'Document uploaded successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $documentId)
    {
        $document = Document::findorFail($documentId);        
        Storage::disk('s3')->delete($document->url);
        $document->delete();
        return back()->withSuccess('Document was deleted successfully');
    }

    /**
     * Download the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id, $documentId)
    {
        $document = Document::findorFail($documentId);
        $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/'.$document->url;
        return response()->download($url);
    }
}
