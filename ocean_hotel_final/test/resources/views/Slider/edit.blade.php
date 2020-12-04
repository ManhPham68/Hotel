@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Slider  </small>
            </h1>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            EDIT SLIDER
        </div>
        <div class="panel-body">
            <form action="{{route('Slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{$slider->name}}" required>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <p>
                        <img src="{{asset($slider->image)}}" style="height: 400px;height: 400px">
                    </p>

                    <input type="file" name="image" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea cols="10" rows="15" name="description" class="ckeditor" required>{{$slider->description}}</textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>

@endsection
