@extends('admin.home')

@section('content')
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
