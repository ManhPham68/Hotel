@extends('admin.home')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Facility </small>
            </h1>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                ADD NEW ROOM TYPE
            </div>
            <div class="panel-body">
                <form action="{{route('RoomType.update',$roomtype->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" class="form-control" placeholder="Type Name" name="name"
                               value="{{$roomtype->name}}">
                    </div>
                    <div class="form-group">

                        <label for="">Bedding *</label>
                        <input type="number" class="form-control" placeholder="Bedding" name="bedding"
                               value="{{$roomtype->bedding}}">

                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection



