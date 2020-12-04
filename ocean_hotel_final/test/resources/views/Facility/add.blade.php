@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Facility  </small>
            </h1>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            ADD NEW FACILITY
        </div>
        <div class="panel-body">
            <form action="{{route('Facility.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form-control">
                        <option value="0" selected id="free"> Free</option>
                        <option value="1" id="not_free"> Not Free</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="0" id="price" class="form-control">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea cols="10" rows="15" name="description" class="ckeditor"></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>

@endsection
