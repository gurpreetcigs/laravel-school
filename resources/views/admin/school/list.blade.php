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
                <div> Schools
                    <div class="page-title-subheading">List for Schools.
                    </div>
                </div>
            </div>  
            @if(auth('admin')->check() || auth('school')->check())
                <div class="page-title-actions">
                    <button type="button" data-toggle="tooltip" title="Add School" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{!! route('admin.school.create') !!}`">
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($schools))
                            @foreach($schools as $key => $school)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->email }}</td>
                                    <td>
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('admin.school.edit', [ 'school' => $school->id]) !!}`">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-edit fa-w-20"></i>
                                            </span>
                                            Edit
                                        </button>
                                        
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-school-{{$school->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                            <form method="POST" action="{{ route('admin.school.destroy', ['school'=>$school->id]) }}" id="delete-school-{{$school->id}}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        </button>
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
                    @if(count($schools))
                        {{ $schools->links() }}
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
