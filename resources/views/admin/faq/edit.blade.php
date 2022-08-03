@extends('layouts.admin')

@section('title', 'Edit Faq')

@section('breadcrumb')
    <div class="page-title">
        <h3>Edit Faq</h3>
        {{ Breadcrumbs::render('create_itinerary', $tourId, $id) }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Create Itinerary</h4>
    </div>

    <form class="ct-pd" action="{{ route('faq.update', ['tour_id' => $tourId, 'id' => $id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="question" class="col-sm col-form-label">Question <strong>*</strong></label>
            <div class="col-sm-11">
                <input id="question" type="text" class="form-control  @error('question') is-invalid @enderror" placeholder="Question"
                    name="question" value="{{ $faq->question }}">
                @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm">Answer <strong>*</strong></label>
            <div class="col-sm-11">
                <textarea name="answer" id="answer" cols="30" rows="10" class="@error('answer') is-invalid @enderror">
                    {{ $faq->answer }}
                </textarea>
                @error('answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group d-flex">
            <label style="margin-right: 45px;">Status</label>
            @if ($faq->status == 1)
                <div class="wrap-radio">
                    <input type="radio" id="radio1" name="status" value="1" checked/>
                    <label for="radio1">Active</label>
                </div>
                <div class="wrap-radio">
                    <input type="radio" id="radio2" name="status" value="2"/>
                    <label for="radio2">Block</label>
                </div>
            @else
                <div class="wrap-radio">
                    <input type="radio" id="radio1" name="status" value="1"/>
                    <label for="radio1">Active</label>
                </div>
                <div class="wrap-radio">
                    <input type="radio" id="radio2" name="status" value="2" checked/>
                    <label for="radio2">Block</label>
                </div>    
            @endif
        </div>

        <div class="form-group row">
            <div class="col-sm-12 d-flex justify-content-center">
                <button class="btn btn-success button-submit" type="submit" style="width: 200px">Save</button>
            </div>
        </div>
    </form>

    <script>
        CKEDITOR.replace('answer');
    </script>
@endsection


