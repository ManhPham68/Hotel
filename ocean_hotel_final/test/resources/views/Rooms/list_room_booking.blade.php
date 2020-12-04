@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Status <small>Room - Booking </small>
            </h1>
        </div>
    </div>
    <form class="col-md-2" method="get"
          style="margin-bottom: 20px;padding-left: 0"
          action="{{route('Room_Booking')}}">
        @csrf
        <div class="row">
            <div class="col-md-10">
                <input class="form-control"
                       style="background-color: white;display: inline"
                       type="text" placeholder="Search by Guest Name"
                       name="name">
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
                                            Room Booking List <span class="badge">{{count($lsBooking_status0)}}</span>
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
                                                        <th>Guest</th>
                                                        <th>Age</th>
                                                        <th>Telephone</th>
                                                        <th>Email</th>
                                                        <th>Room Name</th>
                                                        <th>Number_room</th>
                                                        <th>Check_in</th>
                                                        <th>Check_out</th>
                                                        <th>Status Guest</th>
                                                        <th>Total Cost</th>
                                                        <th>Action</th>
                                                        <th>Destroy</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lsBooking_status0 as $booking)
                                                        <tr>
                                                            <td> {{$booking -> Guest->name}} </td>
                                                            <td> {{$booking -> Guest->age}} </td>
                                                            <td> {{$booking -> Guest->telephone}} </td>
                                                            <td> {{$booking -> Guest->email}} </td>
                                                            <td> {{$booking -> Room->name}} </td>
                                                            <td> {{$booking -> quantity}} </td>
                                                            <td> {{$booking -> check_in}} </td>
                                                            <td> {{$booking -> check_out}} </td>
                                                            <td> {{$booking -> status_guest == 0 ? 'Not confirm' : 'Confirmed'}} </td>
                                                            <td> {{$booking -> RoomBooking->total_cost}} </td>
                                                            <td>
                                                                @can('delete_booking')
                                                                    @if($booking->status_guest == 1)
                                                                        <a data-url="{{route('Booking_confirm_ajax',$booking->id)}}"
                                                                           class="btn btn-primary confirm">
                                                                            Confirm
                                                                        </a>
                                                                    @endif
                                                                @endcan
                                                            </td>
                                                            <td>
                                                                @can('delete_booking')
                                                                    <a data-url="{{route('Booking_destroy_ajax',$booking->id)}}"
                                                                       class="btn btn-danger delete">
                                                                        Delete
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

                                </div>
                            </div>
                        </div>
                    </div>

                    {{$lsBooking_status0->appends(['name'=>$name])->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>
    <script>
        $(function () {
            $('.confirm').click(function () {
                let urlRequest = $(this).data('url');
                let that = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirm it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'GET',
                            url: urlRequest,
                            success: function (data) {
                                if (data.code == 200) {
                                    that.parent().parent().remove();
                                }
                            },
                            error: function () {

                            }
                        });
                        Swal.fire(
                            'Confirmed!',
                            'Your file has been Confirm.',
                            'success'
                        )
                    }
                });
            });
        });
    </script>
@endsection
