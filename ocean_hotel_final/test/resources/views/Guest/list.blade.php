@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small>Guest  </small>
            </h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('Guest.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: #f2f4f6;display: inline" type="text"
                                   placeholder="Search" name="name">
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
            <th>Age</th>
            <th>Address</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Country</th>
            <th>Room Book</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Total cost</th>
            <th>Status</th>
            <th>Destroy</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lsBooking as $booking)
            <tr>
                <td> {{$booking -> id}} </td>
                <td> {{$booking->Guest['name']}} </td>
                <td> {{$booking->Guest['age']}} </td>
                <td> {{$booking->Guest['address']}} </td>
                <td> {{$booking->Guest['telephone']}} </td>
                <td> {{$booking->Guest['email']}} </td>
                <td> {{$booking->Guest['country']}} </td>
                <td> {{$booking->Room['name']}} </td>
                <td> {{$booking->check_in}} </td>
                <td> {{$booking->check_out}} </td>
                <td> {{$booking->RoomBooking['total_cost']}} </td>
                <td>
                    <form method="post" action="{{route('Booking.confirm',$booking->id)}}">
                        @csrf
                        <button class="btn btn-primary">
                            {{$booking->RoomBooking['status'] == 0 ? 'Confirm' : 'Confirmed'}}
                        </button>
                    </form>
                    <form style="margin-top: 15px" method="post" action="{{route('Booking.finish',$booking->id)}}">
                        @csrf
                        <button class="btn btn-primary">
                            Finish
                        </button>
                    </form>
                </td>
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
    {{ $lsBooking-> links() }}
@endsection


