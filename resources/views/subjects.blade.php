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
                            <th>Videos</th>
                            <th style="text-align:left">Action</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @if(count($subjects))
                            @foreach($subjects as $key => $subject)
                            <tr>
                                <td scope="row"> {{ $subject->id }}</th>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $teacher }}</td>
                                <td>{{ count($subject->videos()) }} </td>
                                <td>
                                    @if(auth('admin')->check())
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('admin.videos.index', [ 'id' => $subject->id]) !!}`">
                                    @elseif(auth('school')->check())
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('school.videos.index', [ 'id' => $subject->id]) !!}`">
                                    @else
                                    <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info" onclick="window.location.href = `{!! route('videos.index', [ 'id' => $subject->id]) !!}`">
                                    @endif 
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-eye fa-w-20"></i>
                                        </span>
                                        View
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
