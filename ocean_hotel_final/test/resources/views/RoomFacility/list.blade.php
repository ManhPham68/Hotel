@extends('admin.home')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small>Room Facility  </small>
            </h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('RoomFacility.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: white;display: inline"
                                   type="text" placeholder="Search by Room Name" name="room_name">
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
                        <th>Facility </th>
                        <th>Room </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsRoom_facility as $item)
                        <tr>
                            <td> {{$item -> Facility->name}} </td>
                            <td> {{$item -> Room['name']}} </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsRoom_facility->appends(['room_name' => $room_name])->links() }}

@endsection
