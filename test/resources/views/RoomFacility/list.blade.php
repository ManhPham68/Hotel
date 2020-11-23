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
                                   type="text" placeholder="Search by Room id" name="room_id">
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
                        <th>Facility ID</th>
                        <th>Room ID</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsRoom_facility as $item)
                        <tr>
                            <td> {{$item -> id}} </td>
                            <td> {{$item -> facility_id}} </td>
                            <td> {{$item -> room_id}} </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsRoom_facility->appends(['room_id' => $room_id])->links() }}

@endsection
