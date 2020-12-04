@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small>Room Image </small>
            </h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('RoomImage.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: white;display: inline"
                                   type="text" placeholder="Search by Room Name" name="name_search">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-navbar" type="submit" style="display:inline">
                                <i class="fa fa-search" style="font-size: 20px;background-color: #e5ebf2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
    @if(session('success'))
        <div class="alert alert-danger">
            {{session('success')}}
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room Name</th>
                        <th>Image</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsRoomImage as $item)
                        <tr>
                            <td> {{$item -> id}} </td>
                            <td> {{$item -> Room['name']}} </td>
                            <td><img src="{{$item -> image}}" style="width: 500px;height: 300px;border-radius: 5%"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsRoomImage->appends(['name_search' => $name_search]) -> links() }}


@endsection


