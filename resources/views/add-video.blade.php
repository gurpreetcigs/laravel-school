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
                <div> Video
                    <div class="page-title-subheading">Add Video to {{ $subjectName->name }}.
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
                <form method="POST" action="{{ route('school.videos.store', [ 'id' => $subjectName->id ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="position-relative row form-group"><label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input name="title" id="title" placeholder="Video Title" type="text" class="form-control" required>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="position-relative row form-group"><label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control" required></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="position-relative row form-group"><label for="uploaded_by" class="col-sm-2 col-form-label">Uploaded By</label>
                        <div class="col-sm-10">
                            <input name="uploaded_by" id="uploaded_by" placeholder="Uploaded By" type="text" class="form-control" required>
                            @if ($errors->has('uploaded_by'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('uploaded_by') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="position-relative row form-group"><label for="video" class="col-sm-2 col-form-label">Video</label>
                        <div class="col-sm-10"><input name="video" id="video" type="file" class="form-control-file" required>
                            <small class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                            @if ($errors->has('video'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('video') }}</strong>
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
