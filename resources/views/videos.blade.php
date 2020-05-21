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
                <div> Videos
                    <div class="page-title-subheading">Videos for Physics.
                    </div>
                </div>
            </div>  
            @if(auth('admin')->check() || auth('school')->check())
                <div class="page-title-actions">
                    @if(auth('admin')->check())
                    <button type="button" data-toggle="tooltip" title="Add Video" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('admin.videos.create', [ 'standard'=> $standardId, 'id' => $subjectId ]) !!}`">
                    @else
                    <button type="button" data-toggle="tooltip" title="Add Video" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('school.videos.create', [ 'id' => $subjectId ]) !!}`">
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
                                <th>Description</th>
                                <th>Uploaded By</th>
                                @if(auth('admin')->check() || auth('school')->check())
                                <th>Status</th>
                                @endif
                                <th>Video</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($videos))
                            @foreach($videos as $key => $video)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->description }}</td>
                                    <td>{{ $video->uploaded_by }}</td>
                                    @if(auth('admin')->check() || auth('school')->check())
                                    <td>@if($video->status == '0') <b style="color: red">Pending Approval</b> @else <b style="color: green">Active</b> @endif</td>
                                    @endif
                                    @if(auth('admin')->check())
                                    <td>
                                        <div class="thumbnail" id="video-{{ $key+1 }}" data-name="{{ $key+1 }}" data-url="{{ $url.$video->url }}" onclick="window.location.href = `{!! route('admin.videos.show', [ 'standard'=> $standardId, 'id' => $subjectId, 'video' => $video->id ]) !!}`">
                                        </div>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-video-{{$video->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                            <form method="POST" action="{{ route('admin.videos.destroy', [ 'standard'=> $standardId, 'id' => $subjectId, 'video' => $video->id ]) }}" id="delete-video-{{$video->id}}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </button>
                                        @if($video->status == '0')
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-success" onclick="window.location.href=`{{ route('admin.videos.active', [ 'standard'=> $standardId, 'id' => $subjectId, 'video' => $video->id ]) }}`">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-check fa-w-20"></i>
                                            </span>
                                            Activate
                                        </button>
                                        @endif
                                    </td>
                                    @elseif(auth('school')->check())
                                    <td>
                                        <div class="thumbnail" id="video-{{ $key+1 }}" data-name="{{ $key+1 }}" data-url="{{ $url.$video->url }}" onclick="window.location.href = `{!! route('school.videos.show', [ 'id' => $subjectId, 'video' => $video->id ]) !!}`"></div>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-video-{{$video->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                            <form method="POST" action="{{ route('school.videos.destroy', [ 'id' => $subjectId, 'video' => $video->id ]) }}" id="delete-video-{{$video->id}}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </button>
                                    </td>
                                    @else
                                    <td><div class="thumbnail" id="video-{{ $key+1 }}" data-name="{{ $key+1 }}" data-url="{{ $url.$video->url }}" onclick="window.location.href = `{!! route('videos.show', [ 'id' => $subjectId, 'video' => $video->id ]) !!}`"></div></td>
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
                    @if(count($videos))
                        {{ $videos->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if (session('status'))
    @section('custom_script')
        <script>
        toastr.success("{!! session('status') !!}", 'Success', {timeOut: 3000})
        </script>

    @endsection
@endif
