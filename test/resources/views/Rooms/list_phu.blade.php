@extends('admin.home')

@section('content')
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
                                            Room List <span class="badge"></span>
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
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Room Type</th>
                                                        <th>Bedding</th>
                                                        <th>New Price</th>
                                                        <th>Rating</th>
                                                        <th>Number Room</th>
                                                        <th>Address</th>
                                                        <th>Edit</th>
                                                        <th>Status</th>
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
                                                            <td> {{$room -> rating}} </td>
                                                            <td> {{$room -> number_room}} </td>
                                                            <td> {{$room -> address}} </td>
                                                            <td>
                                                                <form method="get"
                                                                      action="{{route('Rooms.edit',$room->id)}}">
                                                                    @csrf
                                                                    <button type="submit" class="btn-success"> Update
                                                                    </button>
                                                                </form>

                                                                <div style="margin-top: 15px">
                                                                    <form method="get"
                                                                          action="{{route('BookRoom',$room->id)}}">
                                                                        @csrf
                                                                        <button type="submit" class="btn-success">
                                                                            Booking
                                                                        </button>
                                                                    </form>
                                                                </div>

                                                            </td>

                                                            <td>
                                                                <form method="post"
                                                                      action="{{route('Rooms.destroy',$room->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn-danger"
                                                                            onclick="return confirm('Are you sure?')">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
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
                                            Booked Rooms <span class="badge">0</span>
                                        </button>

                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                <div class="panel-body">

                                </div>

                            </div>

                        </div>
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                       class="collapsed">
                                        <button class="btn btn-primary" type="button">
                                            Followers <span class="badge">0</span>
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
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Follow Start</th>
                                                    <th>Permission status</th>


                                                </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                            <a href="messages.php" class="btn btn-primary">More Action</a>
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


