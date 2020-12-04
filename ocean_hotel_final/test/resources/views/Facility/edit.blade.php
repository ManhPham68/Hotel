@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Faciliti  </small>
            </h1>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            EDIT FACILITY
        </div>
        <div class="panel-body">
            <form action="{{route('Facility.update',$facility->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{$facility->name}}">
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control">
                        <option value="0" {{$facility->type == 0 ? 'selected' : ''}}> Free</option>
                        <option value="1" {{$facility->type == 1 ? 'selected' : ''}}> Not Free</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="{{$facility->price}}" id="price" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="ckeditor">{{$facility->description}}</textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>
@endsection
