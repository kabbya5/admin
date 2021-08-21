@extends('layouts.admin.header')

@section('content')
<div class="content">
    <div class="card">
        <div class="card-header">
            Add Imgae Three
        </div>
        <div class="card-body">
            <form action="/admin/image_4/{{$product->id}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <lable class="form-label" for="img-three"> Image three</lable>
                    <input type="file" class="form-control" name='img_three' required>
                </div>
                <button type="submit" class="btn btn-primary"> Save Image </button>
            </form>
        </div>
    </div> 
</div>
 
@endsection
