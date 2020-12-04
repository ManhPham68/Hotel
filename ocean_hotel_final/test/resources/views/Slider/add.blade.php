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
            ADD NEW SLIDER
        </div>
        <div class="panel-body">
            <form action="{{route('Slider.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea cols="10" rows="15" name="description" class="ckeditor" required></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>


@endsection
