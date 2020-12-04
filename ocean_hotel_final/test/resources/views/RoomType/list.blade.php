@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small>Room Type </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: right">
            @can('add_RoomType')
                <button class="btn btn-danger"><a href="{{route('RoomType.create')}}"
                                                  style="color: white;text-decoration: none"> Add Room Type</a>
                </button>
            @endcan
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" action="{{route('RoomType.index')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: white;display: inline" type="text"
                                   placeholder="Search Name" name="name_search">
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
                        <th>Name</th>
                        <th>Bedding</th>
                        <th>Edit</th>
                        <th>Destroy</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsRoomType as $roomtype)
                        <tr>
                            <td> {{$roomtype -> id}} </td>
                            <td> {{$roomtype -> name}} </td>
                            <td> {{$roomtype -> bedding}} </td>
                            <td>
                                @can('edit_RoomType')
                                    <button type="submit" class="btn btn-primary"><a
                                            style="color: white;font-size: 15px;text-decoration: none"
                                            href="{{route('RoomType.edit',$roomtype->id)}}"> Update </a>
                                    </button>
                                @endcan
                            </td>
                            <td style="font-size: 15px">
                                @can('delete_RoomType')
                                    <a data-url="{{route('RoomType_destroy_ajax',$roomtype->id)}}"
                                       class="delete btn btn-danger">
                                        Delete
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsRoomType->appends(['name_search' => $name_search])->links() }}

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>
@endsection
