@extends('home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Status <small>Room - Booking </small>
            </h1>
        </div>
    </div>
    <form class="col-md-12" method="get"
          style="margin-bottom: 20px;padding-left: 0"
          action="{{route('Room_index_frontend')}}">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input class="form-control"
                       style="background-color: white;display: inline"
                       type="date" placeholder="Room Type"
                       name="check_in" value="{{$check_in}}" required>
            </div>
            <div class="col-md-3">
                <input class="form-control"
                       style="background-color: white;display: inline"
                       type="date" placeholder="Price"
                       name="check_out" value="{{$check_out}}" required>
            </div>
            <div class="col-md-3">
                <input class="form-control"
                       style="background-color: white;display: inline"
                       type="text" placeholder="Bedding"
                       name="bedding" value="{{$bedding}}" required>
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
                                                        <th>Feature Image</th>
                                                        <th>Action</th>
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
                                                            <td> <img src="{{asset($room -> feature_image)}}" style="width: 300px;height: 200px;border-radius: 5%"> </td>
                                                            <td>
                                                                <a class="btn btn-primary" href="{{route('Roome_detail',$room->id)}}"> Show</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                                {{$lsRoom->appends(['check_in' => $check_in,'check_out' => $check_out,'bedding' => $bedding])->links()}}
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
