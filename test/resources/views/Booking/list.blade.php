@extends('admin.home')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Booking  </small>
            </h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('Booking.index2')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: white;display: inline" type="text"
                                   placeholder="Search by Room id" name="room_id">
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
                        <th>Guest ID</th>
                        <th>Room ID</th>
                        <th>Quantity</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Destroy</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsBooking as $booking)
                        <tr>
                            <td> {{$booking -> id}} </td>
                            <td> {{$booking->Guest['id']}} </td>
                            <td> {{$booking->Room['id']}} </td>
                            <td> {{$booking->quantity}} </td>
                            <td> {{$booking->check_in}} </td>
                            <td> {{$booking->check_out}} </td>
                            <td>
                                <form method="post" action="{{route('Booking.destroy',$booking->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"> Delete
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
    {{ $lsBooking->appends(['room_id'=>$room_id]) -> links() }}
@endsection


