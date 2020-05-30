<?php

namespace App\Http\Controllers;

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
        $documents = Document::where(['subject_id' => $subjectId, 'status' => '1'])->paginate(5);
        return view('documents', compact('documents', 'subjectId', 'url', 'subjectName'));
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
