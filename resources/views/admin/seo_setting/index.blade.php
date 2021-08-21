@extends('layouts.admin.header')
@section('content')
<div class="seo-setting container">
    @if ($seo)
    <form class="form" method="post" action="/admin/seo/update/{{$seo->id}}/">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="meta_title" class="for-lable"> Meta Title </label>

            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{$seo->meta_title}}">

            @error('meta_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          
        </div>
        <div class="form-group">
              <label for="meta_author" class="for-lable"> 
              Author Name
              </label>

              <input type="text" class="form-control  @error('meta_author') is-invalid @enderror" name="meta_author" value="{{ $seo->meta_author }}">

              @error('meta_author')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="meta_tag" class="for-lable"> 
                  Tages
              </label>

              <input type="text" data-role="tagsinput" class="form-control  @error('meta_tag') is-invalid @enderror" name="meta_tag" value="{{ $seo->meta_tag}}">

              @error('meta_tag')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="meta_description" class="for-lable"> 
                  Metha Description
              </label>

             <textarea name="meta_description" id="" cols="30" rows="3" class="form-control @error('meta_description') is-invalid @enderror"> {{$seo->meta_description }}</textarea>

              @error('meta_tag')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="google_analytice" class="for-lable"> 
                  Google Analytice
              </label>

             <textarea name="google_analytice" id="" cols="30" rows="3" class="form-control @error('google_analytice') is-invalid @enderror"> {{$seo->google_analytice }}</textarea>

              @error('google_analytice')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="metha_description" class="for-lable"> 
                   Other Analytice 
              </label>

             <textarea name="bing_analytics" id="" cols="30" rows="3" class="form-control @error('bing_analytics') is-invalid @enderror"> {{$seo->bing_analytics }}</textarea>

              @error('bing_analytics')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> 
    @else
    <form class="form" method="post" action="{{route('seo.create')}}">
        @csrf
        <div class="form-group">
            <label for="meta_title" class="for-lable"> Meta Title </label>

            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title') }}">

            @error('meta_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          
        </div>
        <div class="form-group">
              <label for="meta_author" class="for-lable"> 
              Author Name
              </label>

              <input type="text" class="form-control  @error('meta_author') is-invalid @enderror" name="meta_author" value="{{ old('meta_author') }}">

              @error('meta_author')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="meta_tag" class="for-lable"> 
                  Tages
              </label>

              <input type="text" data-role="tagsinput" class="form-control  @error('meta_tag') is-invalid @enderror" name="meta_tag" value="{{ old('meta_tag') }}">

              @error('meta_tag')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="meta_description" class="for-lable"> 
                  Metha Description
              </label>

             <textarea name="meta_description" id="" cols="30" rows="3" class="form-control @error('meta_description') is-invalid @enderror"> {{old('metha_description') }}</textarea>

              @error('meta_description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="google_analytice" class="for-lable"> 
                  Google Analytice
              </label>

             <textarea name="google_analytice" id="" cols="30" rows="3" class="form-control @error('google_analytice') is-invalid @enderror"> {{old('google_analytice') }}</textarea>

              @error('google_analytice')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
          <div class="form-group">
              <label for="metha_description" class="for-lable"> 
                   Other Analytice 
              </label>

             <textarea name="bing_analytics" id="" cols="30" rows="3" class="form-control @error('bing_analytics') is-invalid @enderror"> {{old('bing_analytics') }}</textarea>

              @error('bing_analytics')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>  
    @endif
   
</div>
    


<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    
@endsection