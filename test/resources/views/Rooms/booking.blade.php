@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Booking <small> Room  </small>
            </h1>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Session::has('message'))
        <p class="alert alert-danger" style="font-weight: bold">
            {{\Illuminate\Support\Facades\Session::get('message')}}
        </p>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    BOOK A NEW ROOM
                </div>
                <div class="panel-body">
                    <form method="post" action="{{route('BookRoom.save',$roombooking->id)}}">
                        @csrf
                        <div class="form-group">
                            <label>Quantity</label>
                            <select name="quantity" class="form-control">
                                @for($i = 0;$i<$roombooking->number_room;$i++)
                                    <option value="{{$i+1}}">{{$i+1}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <select name="title" class="form-control" required>
                                <option value="Mr">Mr.</option>
                                <option value="Mrs">Mrs.</option>
                                <option value="Miss">Miss.</option>
                                <option value="Ms">Ms.</option>
                                <option value="Sir">Sir.</option>
                                <option value="Madam">Madam.</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your name" required>
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Your age" required>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Your address" required>
                        </div>

                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Your telephone" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Your email" required>
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" placeholder="Your country" required>
                        </div>

                        <div class="form-group">
                            <label>
                                Check in
                            </label>
                            <input class="form-control" type="date" name="check_in" required>
                        </div>
                        <div class="form-group">
                            <label>
                                Check out
                            </label>
                            <input class="form-control" type="date" name="check_out" required>
                        </div>

                        <div class="form-group">
                            <label>Facilities</label>
                            <div class="row">
                                @foreach($facility as $item)
                                    <div class="col-md-6">
                                        <input type="checkbox" name="facilities[]"
                                               value="{{$item->id}}" {{$item->type == 0 ? 'checked' : ''}}>
                                        <label>{{$item->name}}
                                            - {{$item->type == 0 ? 'Free' : 'Not Free -'}} {{$item->type == 1 ? $item->price . ' $' : ''}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger">Book</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    INFORMATION ROOM
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Room Type</th>
                            <th>Bedding</th>
                            <th>New price</th>
                            <th>Feature Image</th>
                            <th>Openning Room</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> {{$roombooking -> name}} </td>
                            <td> {{$roombooking -> RoomType['name'] }} </td>
                            <td> {{$roombooking -> RoomType['bedding'] }} </td>
                            <td> {{$roombooking -> new_price}} </td>
                            <td><img src="{{asset($roombooking -> feature_image)}}" style="border-radius: 5%" width="267px" height="267px"></td>
                            <td> {{$roombooking -> number_room}} </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





@endsection
