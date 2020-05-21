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
                <div> Students
                    <div class="page-title-subheading">List for Students.
                    </div>
                </div>
            </div>  
            @if(auth('admin')->check() || auth('school')->check())
                <div class="page-title-actions">
                    <button type="button" data-toggle="tooltip" title="Add Student" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('admin.student.create') !!}`">
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($students))
                            @foreach($students as $key => $student)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $student->username }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>@if($student->expires_at <= $today) <b style="color: red">Expired</b> @else <b style="color: green">Active</b> @endif</td>
                                    <td>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('admin.student.edit', [ 'student' => $student->id]) !!}`">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-edit fa-w-20"></i>
                                            </span>
                                            Edit
                                        </button>
                                        
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-student-{{$student->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                            <form method="POST" action="{{ route('admin.student.destroy', ['student'=>$student->id]) }}" id="delete-student-{{$student->id}}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </button>

                                        @if($student->expires_at <= $today)
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-success" onclick="window.location.href = `{!! route('admin.student.activate-view', [ 'student' => $student->id]) !!}`">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-check fa-w-20"></i>
                                            </span>
                                            Activate
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
                    @if(count($students))
                        {{ $students->links() }}
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
