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
                    <div class="page-title-subheading">{{ $video->title }}.
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <div class="main-card mb-3 card">
                <div width="100%" id="video-player" data-url="{{ $url.$video->url }}"></div>
                <div class="card-body"><h5 class="card-title">{{ $video->title }}</h5>
                {{ $video->description }}
                <br>
                <small class="text-muted">Uploaded by <b>{{ $video->uploaded_by }}</b></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
