@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Status <small>Room - Booking </small>
            </h1>
        </div>
    </div>
    <form class="col-md-2" method="get"
          style="margin-bottom: 20px;padding-left: 0"
          action="{{route('Rooms.index')}}">
        @csrf
        <div class="row">
            <div class="col-md-10">
                <input class="form-control"
                       style="background-color: white;display: inline"
                       type="text" placeholder="Search by Room Type"
                       name="room_type_name">
            </div>
            <div class="col-md-2">
                <button class="btn btn-default" type="submit"
                        style="display:inline">
                    <i class="fa fa-search"
                       style="font-size: 20px;background-color: white"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12" style="text-align: right;margin-bottom: 15px">
            @can('add_room')
                <button class="btn btn-danger"><a href="{{route('Rooms.create')}}"
                                                  style="color: white;text-decoration: none"> Add Room</a>
                </button>
            @endcan
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-danger" style="font-size: 25px">
            {{session('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <button class="btn btn-default" type="button">
                                            Room List <span class="badge">{{count($lsRoom)}}</span>
                                        </button>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse in" style="height: auto;">

                                <div class="panel-body">

                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                                <p class="alert-danger alert">
                                                    {{\Illuminate\Support\Facades\Session::get('message')}}
                                                </p>
                                            @endif


                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Room Type</th>
                                                        <th>Bedding</th>
                                                        <th>New Price</th>
                                                        <th>Rating</th>
                                                        <th>Openning Room</th>
                                                        <th>Edit</th>
                                                        <th>Destroy</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lsRoom as $room)
                                                        <tr>
                                                            <td> {{$room -> name}} </td>
                                                            <td> {{$room -> RoomType['name'] }} </td>
                                                            <td> {{$room -> RoomType['bedding'] }} </td>

                                                            <td> {{$room -> new_price}} </td>
                                                            <td> {{$room -> rating}}*</td>
                                                            <td> {{$room -> number_room}} </td>
                                                            <td>
                                                                <form method="get"
                                                                      action="{{route('Rooms.edit',$room->id)}}">
                                                                    @csrf
                                                                    @can('edit_room')
                                                                        <button type="submit" class="btn btn-primary">
                                                                            Update
                                                                        </button>
                                                                    @endcan
                                                                </form>
                                                            </td>
                                                            <td>
                                                                @can('delete_room')
                                                                    <a data-url="{{route('Room_destroy_ajax',$room->id)}}"
                                                                       class="btn btn-danger delete">
                                                                        Delete
                                                                    </a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                                {{$lsRoom->appends(['room_type_name' =>$room_type_name])->links()}}
                                            </div>
                                        </div>
                                    </div>

                                <!-- End  Basic Table  -->
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>

@endsection
