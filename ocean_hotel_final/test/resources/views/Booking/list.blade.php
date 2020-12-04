@extends('admin.home')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Booking </small>
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
                                   placeholder="Search by Room Name" name="room_name">
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
                        <th>Guest Name</th>
                        <th>Room Name</th>
                        <th>Quantity</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Destroy</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsBooking as $booking)
                        <tr>
                            <td> {{$booking->Guest->name}} </td>
                            <td> {{$booking->Room->name}} </td>
                            <td> {{$booking->quantity}} </td>
                            <td> {{$booking->check_in}} </td>
                            <td> {{$booking->check_out}} </td>
                            <td>
                                @can('delete_booking')
                                    <a data-url="{{route('Booking_destroy_ajax',$booking->id)}}" class="delete btn btn-danger"> Delete
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsBooking->appends(['room_name'=>$room_name]) -> links() }}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>

@endsection
