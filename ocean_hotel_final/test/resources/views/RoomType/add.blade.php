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
                <form action="{{route('RoomType.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" class="form-control" placeholder="Type Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Bedding *</label>
                        <input type="number" class="form-control" placeholder="Bedding" name="bedding">

                    </div>
                    <input type="submit" value="Add New" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>


@endsection

