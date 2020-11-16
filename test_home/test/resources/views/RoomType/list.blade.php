@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-6"><h1>Room Type manager</h1></div>
        <div class="col-md-6" style="text-align: right">
            <button class="btn btn-danger"><a href="{{route('RoomType.create')}}" style="color: white"> Add Room Type</a>
            </button>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" action="{{route('RoomType.index')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: #f2f4f6;display: inline" type="text" placeholder="Search RoomType" name="name_search">
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
                    <button type="submit" class="btn-success"><a
                            style="color: white;font-size: 15px;text-decoration: none"
                            href="{{route('RoomType.edit',$roomtype->id)}}"> Update </a></button>
                </td>
                <td style="font-size: 15px">
                    <form method="post" action="{{route('RoomType.destroy',$roomtype->id)}}">
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
    {{ $lsRoomType->appends(['name_search' => $name_search])->links() }}

@endsection


