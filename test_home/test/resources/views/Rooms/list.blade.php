@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Room manager</h1>
        </div>
        <div class="col-md-6" style="text-align: right">
            <button class="btn btn-danger"><a href="{{route('Rooms.create')}}" style="color: white"> Add Room</a>
            </button>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-3" action="{{route('Rooms.index')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: #f2f4f6;display: inline" type="text" placeholder="Search Room Type" name="room_type_name">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-navbar" type="submit" style="display:inline">
                                <i class="fas fa-search"></i>
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

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Room_Type_Id</th>
            <th>Bedding</th>
            <th>new_price</th>
            <th>old_price</th>
            <th>rating</th>
            <th>feature_image</th>
            <th>number_room</th>
            <th>address</th>
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
                <td> {{$room -> old_price}} </td>
                <td> {{$room -> rating}} </td>
                <td><img src="{{asset($room -> feature_image)}}" width="267px" height="267px"></td>
                <td> {{$room -> number_room}} </td>
                <td> {{$room -> address}} </td>
                <td>
                    <form method="get" action="{{route('Rooms.edit',$room->id)}}">
                        @csrf
                        <button type="submit" class="btn-success"> Update</button>
                    </form>

                    <div style="margin-top: 15px">
                        <form method="get" action="{{route('BookRoom',$room->id)}}">
                            @csrf
                            <button type="submit" class="btn-success"> Booking</button>
                        </form>
                    </div>

                </td>

                <td>
                    <form method="post" action="{{route('Rooms.destroy',$room->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')"> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {{   $lsRoom->appends(['room_type_name' => $room_type_name])->links() }}

@endsection


