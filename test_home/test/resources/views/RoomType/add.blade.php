@extends('admin.home')
@section('content')
    <form action="{{route('RoomType.store')}}" method="post">
        @csrf
        <h3>Add new</h3>

        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label>Name *</label>
                    <input type="text" class="form-control" placeholder="Type Name" name="name">
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="">Bedding *</label>
                    <input type="number" class="form-control" placeholder="Bedding" name="bedding">
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
@endsection



