@extends('layouts.admin')

@section('title', 'Albums')

@section('breadcrumb')
    <div class="page-title">
        <h3>Albums</h3>
        {{ Breadcrumbs::render('album_tour', $id) }}
    </div>
@endsection

@section('content')
    <div class="content-header-album">
        <h4 class="p-2">Albums</h4>
        <div class="wrap-upload d-flex justify-content-center">
            
                <div class="upload-btn-wrapper">
                    <div class="btn">
                        <i class="fa fa-upload"></i>
                        <strong>Upload</strong>
                    </div>
                    <input type="file" id="upload-image" name="file[]" multiple />
                    <input type="text" id="url-upload" class="d-none" value="{{ route('album.upload', $id) }}">
                </div>
           
        </div>
        <hr>
        <div class="wrap-album">
            @if ($album->isEmpty())
                <strong id="empty-album" class="mb-2">Empty Album</strong>
            @else
                @foreach ($album as $item)
                    <div class="wrap-image">
                        <img src="{{ asset('storage/upload/' . $item->image) }}" alt="">
                        <i class="fal fa-trash-alt" onclick="deleteImageAjax($(this).parent('div'), '{{ route("album.destroy", $item->id) }}')"></i>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/album.js') }}"></script>
@endsection
