@extends('home')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Booking <small> Room </small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    BOOK A NEW ROOM
                </div>
                <div class="panel-body" style="padding-bottom: 70px">
                    <form method="post" action="{{route('BookRoom.save',$roombooking->id)}}">
                        @csrf
                        <div class="form-group">
                            <label>Quantity</label>
                            <select name="quantity" class="form-control">
                                @for($i = 0;$i<$roombooking->number_room;$i++)
                                    <option
                                        value="{{$i+1}}" {{$booking->quantity == ($i+1) ? 'selected' : ''}}>{{$i+1}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Title</label>
                            <select name="title" class="form-control" required>
                                <option value="Mr" {{$booking->Guest->title == 'Mr' ? 'selected' : ''}}>Mr.</option>
                                <option value="Mrs" {{$booking->Guest->title == 'Mrs' ? 'selected' : ''}}>Mrs.</option>
                                <option value="Miss" {{$booking->Guest->title == 'Miss' ? 'selected' : ''}}>Miss.
                                </option>
                                <option value="Ms" {{$booking->Guest->title == 'Ms' ? 'selected' : ''}}>Ms.</option>
                                <option value="Sir" {{$booking->Guest->title == 'Sr' ? 'selected' : ''}}>Sir.</option>
                                <option value="Madam" {{$booking->Guest->title == 'Madam' ? 'selected' : ''}}>Madam.
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your name" required
                                   value="{{$booking->Guest->name}}">
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" placeholder="Your age" required
                                   value="{{$booking->Guest->age}}">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Your address" required
                                   value="{{$booking->Guest->address}}">
                        </div>

                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Your telephone"
                                   required value="{{$booking->Guest->telephone}}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Your email" required
                                   value="{{$booking->Guest->email}}">
                        </div>

                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" class="form-control" placeholder="Your country" required
                                   value="{{$booking->Guest->country}}">
                        </div>

                        <div class="form-group">
                            <label>
                                Check in
                            </label>
                            <input class="form-control" type="date" name="check_in"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>
                                Check out
                            </label>
                            <input class="form-control" type="date" name="check_out"
                                   required>
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
        <div class="col-md-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    INFORMATION ROOMBOOKING
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
                            <td><img src="{{asset($roombooking -> feature_image)}}" style="border-radius: 5%"
                                     width="267px" height="267px"></td>
                            <td> {{$roombooking -> number_room}} </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading" style="color: blue">
                    INFORMATION ROOM RELATIONSHIP
                </div>
                <div class="form-group">
                    <form class="col-md-12" method="get" style="margin-bottom: 20px;padding-left: 0"
                          action="{{route('BookRoom_next',['room_id' => $roombooking->id,'old_booking' => $booking->id])}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control"
                                       style="background-color: white;display: inline"
                                       type="date" placeholder="Room Type"
                                       name="check_in" value="{{$check_in}}" required>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control"
                                       style="background-color: white;display: inline"
                                       type="date" placeholder="Price"
                                       name="check_out" value="{{$check_out}}" required>
                            </div>
                            <div class="col-md-3">
                                <input class="form-control"
                                       style="background-color: white;display: inline"
                                       type="text" placeholder="Bedding"
                                       name="bedding" value="{{$bedding}}" required>
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
                </div>
                <div class="panel-body" id="table_data">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Room Type</th>
                            <th>Bedding</th>
                            <th>New price</th>
                            <th>Feature Image</th>
                            <th>Openning Room</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lsRoom as $item)
                            <tr>
                                <td> {{$item -> name}} </td>
                                <td> {{$item -> RoomType['name'] }} </td>
                                <td> {{$item -> RoomType['bedding'] }} </td>
                                <td> {{$item -> new_price}} </td>
                                <td><img src="{{asset($item -> feature_image)}}" style="border-radius: 5%" width="267px"
                                         height="267px"></td>
                                <td> {{$item -> number_room}} </td>
                                <td>
                                    @if($item->number_room > 0)
                                        <div style="margin-top: 15px">
                                            <form method="get"
                                                  action="{{route('BookRoom_next',['room_id'=>$item->id,'old_booking' => $booking->id])}}">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-primary">
                                                    Booking
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$lsRoom->appends(['bedding' => $bedding,'check_in' => $check_in,'check_out' => $check_out])->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
