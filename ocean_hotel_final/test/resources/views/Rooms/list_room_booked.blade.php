@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Status <small>Room - List </small>
            </h1>
        </div>
    </div>
    <form class="col-md-2" method="get"
          style="margin-bottom: 20px;padding-left: 0"
          action="{{route('Room_Booked')}}">
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
    @if(session('success'))
        <div class="alert alert-danger" style="font-size: 25px">
            {{session('success')}}
        </div>
    @endif
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
                                            Room Booked List <span class="badge">{{count($lsBooking_status1)}}</span>
                                        </button>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body">

                                    @foreach($lsBooking_status1 as $booking)
                                        <div class='col-md-3 col-sm-12 col-xs-12'>
                                            <div class='panel panel-primary text-center no-boder bg-color-blue'>
                                                <div class='panel-body'>
                                                    <i class='fa fa-users fa-5x'></i>
                                                    <h3>{{$booking->Guest->name}}</h3>
                                                </div>
                                                <div class='panel-footer back-footer-blue'>
                                                    <a href="{{route('Booking.printer',$booking->id)}}">
                                                        @can('list_booking')
                                                            <button class='btn btn-primary btn' data-toggle='modal'
                                                                    data-target='#myModal'>
                                                                Show
                                                            </button>
                                                        @endcan
                                                    </a>
                                                    <p>
                                                        {{$booking->Room->name}} -
                                                        Check_out: {{date('d/m/Y',strtotime($booking->check_out))}}
                                                    </p>
                                                    @can('delete_booking')
                                                        <a data-url="{{route('Booking_finish_ajax',$booking->id)}}"
                                                           class="finish btn btn-danger">
                                                            Finish
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{$lsBooking_status1->appends(['name'=>$name])->links()}}
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
            $('.finish').click(function () {
                let urlRequest = $(this).data('url');
                let that = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Finish it!'
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
                            'Finished!',
                            'Your file has been Finish.',
                            'success'
                        )
                    }
                });
            });
        });
    </script>
@endsection
