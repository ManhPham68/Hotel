@extends('admin.home')

@section('content')
        <div class="row">
            <div class="col-md-6"><h1>Room Image manager</h1></div>
        </div>
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-12">
                <div class="row">
                    <form class="col-md-2" method="get" action="{{route('RoomImage.index')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control" style="background-color: #f2f4f6;display: inline"
                                       type="text" placeholder="Search by id" name="name_search">
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

        <table class="table col-md-12">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Room Id</th>
                <th>Room Name</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lsRoomImage as $item)
                <tr>
                    <td> {{$item -> id}} </td>
                    <td> {{$item -> Room['id']}} </td>
                    <td> {{$item -> Room['name']}} </td>
                    <td><img src="{{$item -> image}}" style="width: 300px;height: 200px"></td>
                </tr>
            @endforeach
            </tbody>

        </table>
        {{ $lsRoomImage->appends(['name_search' => $name_search]) -> links() }}


@endsection


