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
                <div> Add Subject
                    <div class="page-title-subheading">Add Subjects for {{ $standardData->name }}.
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Details</h5>
                <form method="POST" action="{{ route('admin.subject.store', [ 'id' => $standardData->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="position-relative row form-group"><label for="title" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <input name="subject" id="subject" placeholder="Name" type="text" class="form-control" required>
                            @if ($errors->has('subject'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="position-relative row form-check">
                        <div class="col-sm-10 offset-sm-2">
                            <button class="btn btn-secondary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
