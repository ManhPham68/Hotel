@extends('admin.home')

@section('content')
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
