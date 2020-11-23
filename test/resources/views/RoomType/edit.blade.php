@extends('admin.home')
@section('content')
    <form action="{{route('RoomType.update',$roomtype->id)}}" method="post">
        @csrf
        @method('PUT')
        <h3>Update</h3>

        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label>Name *</label>
                    <input type="text" class="form-control" placeholder="Type Name" name="name" value="{{$roomtype->name}}">
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="">Bedding *</label>
                    <input type="number" class="form-control" placeholder="Bedding" name="bedding" value="{{$roomtype->bedding}}">
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </form>
@endsection



