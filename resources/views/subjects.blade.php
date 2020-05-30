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
                <div> Subjects
                    <div class="page-title-subheading">Videos for all subjects.
                    </div>
                </div>
            </div>
            @if(auth('admin')->check())
                <div class="page-title-actions">
                    <button type="button" data-toggle="tooltip" title="Add Video" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('admin.subject.create', [ 'id' => $standardId ?? 0 ]) !!}`">
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
                <div class="card-body"><h5 class="card-title">Subjects</h5>
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th style="text-align:left">Action</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @if(count($subjects))
                            @foreach($subjects as $key => $subject)
                            <tr>
                                <td scope="row"> {{ $key+1 }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $teacher }}</td>
                                <td>
                                    @if(auth('admin')->check())
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('admin.videos.index', [ 'standard' => $standardId, 'id' => $subject->id]) !!}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View Videos
                                    </button>
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('admin.documents.index', [ 'standard' => $standardId, 'id' => $subject->id]) !!}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View Assignment
                                    </button>
                                    @elseif(auth('school')->check())
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('school.videos.index', [ 'id' => $subject->id]) !!}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View Videos
                                    </button>
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('school.documents.index', [ 'id' => $subject->id]) !!}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View Assignment
                                    </button>
                                    @else
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('videos.index', [ 'id' => $subject->id]) !!}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View Videos
                                    </button>
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('documents.index', ['id' => $subject->id]) !!}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View Assignment
                                    </button>
                                    @endif 
                                    @if(auth('admin')->check())
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-subject-{{$subject->id}}').submit()">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-trash fa-w-20"></i>
                                        </span>
                                        Delete
                                        <form method="POST" action="{{ route('admin.subject.destroy', ['id' => $standardId, 'subject' => $subject->id]) }}" id="delete-subject-{{$subject->id}}">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </button>
                                    @endif 
                                </td>
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
                    @if(count($subjects))
                        {{ $subjects->links() }}
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