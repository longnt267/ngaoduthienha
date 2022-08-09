@extends('layouts.admin')

@section('title', 'Article')

@section('breadcrumb')
    <div class="page-title">
        <h3>Article</h3>
        {{ Breadcrumbs::render('article') }}
    </div>
@endsection

@section('content')
    <div class="content-header">
        <h4>Article</h4>
    </div>

    <form class="ct-pd row" action="{{ route('article.save') }}" method="post">
        @csrf
        <div class="col-sm-12">
          <div class="form-group" style="margin-top: 20px;">
              <label for="term">About us</label>
              <textarea name="about_us" id="about_us" rows="10" cols="80">
                 {!! $about_us !!}
              </textarea>
          </div>
      </div>

      <div class="col-sm-12">
          <div class="form-group" style="margin-top: 20px;">
              <label for="term">Term & conditions</label>
              <textarea name="term" id="term" rows="10" cols="80">
                  {!! $term !!}
              </textarea>
          </div>
      </div>

      <div class="col-sm-12">
          <div class="form-group" style="margin-top: 20px;">
              <label for="privacy_policy">Privacy policy</label>
              <textarea name="privacy_policy" id="privacy_policy" rows="10" cols="80">
                {!! $privacy_policy !!}
              </textarea>
          </div>
      </div>

      <div class="col-sm-12">
          <div class="form-group" style="margin-top: 20px;">
              <label for="guest_policy">Guest policy</label>
              <textarea name="guest_policy" id="guest_policy" rows="10" cols="80">
                {!! $guest_policy !!}
              </textarea>
          </div>
      </div>

      <div class="col-sm-12" style="display: flex; justify-content: center;">
          <input type="submit" class="btn btn-success" value="Save" style="width: 150px;">
      </div>
    </form>
    <script>
      CKEDITOR.replace('about_us');
      CKEDITOR.replace('term');
      CKEDITOR.replace('privacy_policy');
      CKEDITOR.replace('guest_policy');
    </script>
@endsection

@section('script')

@endsection
