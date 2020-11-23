@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Status <small>Room - Booking </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: right;margin-bottom: 15px">
            <button class="btn btn-danger"><a href="{{route('Rooms.create')}}"
                                              style="color: white;text-decoration: none"> Add Room</a>
            </button>
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

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Room Type</th>
                                                        <th>Bedding</th>
                                                        <th>New Price</th>
                                                        <th>Rating</th>
                                                        <th>Openning Room</th>
                                                        <th>Address</th>
                                                        <th>Edit</th>
                                                        <th>Destroy</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lsRoom as $room)
                                                        <tr>
                                                            <td> {{$room -> id}} </td>
                                                            <td> {{$room -> name}} </td>
                                                            <td> {{$room -> RoomType['name'] }} </td>
                                                            <td> {{$room -> RoomType['bedding'] }} </td>

                                                            <td> {{$room -> new_price}} </td>
                                                            <td> {{$room -> rating}}*</td>
                                                            <td> {{$room -> number_room}} </td>
                                                            <td> {{$room -> address}} </td>
                                                            <td>
                                                                <form method="get"
                                                                      action="{{route('Rooms.edit',$room->id)}}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">
                                                                        Update
                                                                    </button>
                                                                </form>
                                                                @if($room->number_room > 0)
                                                                    <div style="margin-top: 15px">
                                                                        <form method="get"
                                                                              action="{{route('BookRoom',$room->id)}}">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                Booking
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a data-url="{{route('Room_destroy_ajax',$room->id)}}"
                                                                   class="btn btn-danger delete">
                                                                    Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                {{$lsRoom->appends(['room_type_name' =>$room_type_name])->links()}}
                                <!-- End  Basic Table  -->
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       class="collapsed">
                                        <button class="btn btn-primary" type="button">
                                            Booked Rooms <span class="badge">{{count($lsBooking_status1)}}</span>
                                        </button>
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">

                                <div class="panel-body">
                                    @foreach($lsBooking_status1 as $booking)
                                        @foreach($booking as $item)
                                            <div class='col-md-3 col-sm-12 col-xs-12'>
                                                <div class='panel panel-primary text-center no-boder bg-color-blue'>
                                                    <div class='panel-body'>
                                                        <i class='fa fa-users fa-5x'></i>
                                                        <h3>{{$item->Guest->name}}</h3>
                                                    </div>
                                                    <div class='panel-footer back-footer-blue'>
                                                        <a href="{{route('Booking.printer',$item->id)}}">
                                                            <button class='btn btn-primary btn' data-toggle='modal'
                                                                    data-target='#myModal'>
                                                                Show
                                                            </button>
                                                        </a>
                                                        <p>
                                                            {{$item->Room->name}} -
                                                            Check_out: {{date('d/m/Y',strtotime($item->check_out))}}
                                                        </p>

                                                        <a data-url="{{route('Booking_finish_ajax',$item->id)}}" class="delete btn btn-danger">
                                                            Finish and Destroy
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>

                            </div>


                        </div>

                    </div>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                   class="collapsed">
                                    <button class="btn btn-primary" type="button">
                                        New Booking Room <span class="badge">{{count($lsBooking_status0)}}</span>
                                    </button>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Telephone</th>
                                                <th>Email</th>
                                                <th>Room Book</th>
                                                <th>Number RoomBook</th>
                                                <th>Check in</th>
                                                <th>Check out</th>
                                                <th>Action</th>
                                                <th>Destroy</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lsBooking_status0 as $booking)
                                                @foreach($booking as $item)
                                                    <tr>
                                                        <td> {{$item -> id}} </td>
                                                        <td> {{$item->Guest->name}} </td>
                                                        <td> {{$item->Guest->age}} </td>
                                                        <td> {{$item->Guest->telephone}} </td>
                                                        <td> {{$item->Guest->email}} </td>
                                                        <td> {{$item->Room->name}} </td>
                                                        <td> {{$item->quantity}} </td>
                                                        <td> {{date('d/m/Y',strtotime($item->check_in))}} </td>
                                                        <td> {{date('d/m/Y',strtotime($item->check_out))}} </td>
                                                        <td>
                                                            <form method="post"
                                                                  action="{{route('Booking.confirm',$item->id)}}">
                                                                @csrf
                                                                <button class="btn btn-primary" onclick="return confirm('Are you sure?')">
                                                                    {{$item->RoomBooking->status == 0 ? 'Confirm' : 'Confirmed'}}
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <a data-url="{{route('Booking_destroy_ajax',$item->id )}}"
                                                               class="delete btn btn-danger">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
