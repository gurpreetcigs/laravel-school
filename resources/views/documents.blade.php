@extends('layouts.app')

@section('content')

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                    </i>
                </div>
                <div> Documents
                    <div class="page-title-subheading">Documents for {{ $subjectName->name }}.
                    </div>
                </div>
            </div>  
            @if(auth('admin')->check() || auth('school')->check())
                <div class="page-title-actions">
                    @if(auth('admin')->check())
                    <button type="button" data-toggle="tooltip" title="Add Document" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('admin.documents.create', [ 'standard'=> $standardId, 'id' => $subjectId ]) !!}`">
                    @else
                    <button type="button" data-toggle="tooltip" title="Add Document" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('school.documents.create', [ 'id' => $subjectId ]) !!}`">
                    @endif
                    
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Add 
                    </button>
                </div>
            @endif
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body" id="video-list">
                    <table class="mb-0 table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Uploaded By</th>
                                @if(auth('admin')->check() || auth('school')->check())
                                <th>Status</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($documents))
                            @foreach($documents as $key => $document)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $document->title }}</td>
                                    <td>{{ $document->uploaded_by }}</td>
                                    @if(auth('admin')->check() || auth('school')->check())
                                    <td>@if($document->status == '0') <b style="color: red">Pending Approval</b> @else <b style="color: green">Active</b> @endif</td>
                                    @endif
                                    @if(auth('admin')->check())
                                    <td>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="downloadURI(`{{ $url.$document->url }}`)">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            Download
                                        </button>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-document-{{$document->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                            <form method="POST" action="{{ route('admin.documents.destroy', [ 'standard'=> $standardId, 'id' => $subjectId, 'document' => $document->id ]) }}" id="delete-document-{{$document->id}}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </button>
                                        @if($document->status == '0')
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-success" onclick="window.location.href=`{{ route('admin.documents.active', [ 'standard'=> $standardId, 'id' => $subjectId, 'document' => $document->id ]) }}`">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-check fa-w-20"></i>
                                            </span>
                                            Activate
                                        </button>
                                        @endif
                                    </td>
                                    @elseif(auth('school')->check())
                                    <td>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="downloadURI(`{{ $url.$document->url }}`)">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            Download
                                        </button>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-document-{{$document->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                            <form method="POST" action="{{ route('school.documents.destroy', [ 'id' => $subjectId, 'document' => $document->id ]) }}" id="delete-document-{{$document->id}}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </button>
                                    </td>
                                    @else
                                    <td>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="downloadURI(`{{ $url.$document->url }}`)">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-download fa-w-20"></i>
                                            </span>
                                            Download
                                        </button>
                                    </td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td scope="row" class="text-align" colspan=5> No Record Found !!</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <br>
                    @if(count($documents))
                        {{ $documents->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
    @if (session('status'))
    <script>
        toastr.success("{!! session('status') !!}", 'Success', {timeOut: 3000})
    </script>
    @endif
        <script>
        
        function downloadURI(uri) 
        {
            var link = document.createElement("a");
            link.href = uri;
            link.click();
        }
        </script>
@endsection