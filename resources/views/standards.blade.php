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
                <div> Standards
                    <div class="page-title-subheading">List for all standards.
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Add Video" data-placement="bottom" class="btn-shadow mr-3 btn btn-info" onclick="window.location.href = `{{ route('admin.standard.create') }}`">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Add 
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Standards</h5>
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Standard</th>
                            <th>Created At</th>
                            <th style="text-align:left">Action</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @if(count($standards))
                            @foreach($standards as $key => $standard)
                            <tr>
                                <td scope="row"> {{ $standard->id }}</th>
                                <td>{{ $standard->name }}</td>
                                <td>{{ $standard->created_at }}</td>
                                <td>
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{{ route('admin.standard.show', [ 'standard' => $standard->id ]) }}`">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        Subjects
                                    </button>

                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onclick="$('#delete-standard-{{$standard->id}}').submit()">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                            Delete
                                        <form method="POST" action="{{ route('admin.standard.destroy', ['standard'=> $standard->id]) }}" id="delete-standard-{{$standard->id}}">
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
                    @if(count($standards))
                        {{ $standards->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
<script>
    function deleteStandard(url){
        $('#deleteModal').model('show')
    }
</script>
@if (session('status'))
    <script>
        toastr.success("{!! session('status') !!}", 'Success', {timeOut: 3000})
    </script>
@endif
@endsection

