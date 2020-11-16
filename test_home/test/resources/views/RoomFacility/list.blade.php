@extends('admin.home')
@section('content')
    <div class="row">
        <div class="col-md-6"><h1>Room Facility manager</h1></div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: #f2f4f6;display: inline"
                                   type="text" placeholder="Search by id" name="">
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
            <th>Facility ID</th>
            <th>Room ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach($room_facility as $item)
            <tr>
                <td> {{$item -> id}} </td>
                <td> {{$item -> facility_id}} </td>
                <td> {{$item -> room_id}} </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {{ $room_facility-> links() }}

@endsection
