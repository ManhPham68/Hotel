@extends('admin.home')

@section('content')
    <h1> The booking room</h1>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Room_Type_Id</th>
            <th>Bedding</th>
            <th>new_price</th>
            <th>old_price</th>
            <th>rating</th>
            <th>feature_image</th>
            <th>number_room</th>
            <th>address</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td> {{$roombooking -> id}} </td>
            <td> {{$roombooking -> name}} </td>
            <td> {{$roombooking -> RoomType['name'] }} </td>
            <td> {{$roombooking -> RoomType['bedding'] }} </td>
            <td> {{$roombooking -> new_price}} </td>
            <td> {{$roombooking -> old_price}} </td>
            <td> {{$roombooking -> rating}} </td>
            <td><img src="{{asset($roombooking -> feature_image)}}" width="267px" height="267px"></td>
            <td> {{$roombooking -> number_room}} </td>
            <td> {{$roombooking -> address}} </td>
        </tr>
        </tbody>
    </table>

    <div class="row" style="margin-top: 20px">
        <form method="post" action="{{route('BookRoom.save',$roombooking->id)}}">
            @csrf
            <div class="form-group">
                <label>Quantity</label>
                <input name="quantity" type="number" class="form-control" placeholder="Number of roombooking">
            </div>
            <div class="form-group">
                <label for="name">Title</label>
                <select name="title" class="form-control">
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
                <input type="text" name="name" class="form-control" placeholder="Your name">
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" class="form-control" placeholder="Your age">
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Your address">
            </div>

            <div class="form-group">
                <label>Telephone</label>
                <input type="text" name="telephone" class="form-control" placeholder="Your telephone">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Your email">
            </div>

            <div class="form-group">
                <label>Country</label>
                <input type="text" name="country" class="form-control" placeholder="Your country">
            </div>

            <div class="form-group">
                <label>
                    Check in
                </label>
                <input class="form-control" type="date" name="check_in" >
            </div>
            <div class="form-group">
                <label>
                    Check out
                </label>
                <input class="form-control" type="date" name="check_out">
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

@endsection
