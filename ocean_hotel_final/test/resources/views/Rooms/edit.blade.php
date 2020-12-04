@extends('admin.home')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Status <small>Room - Booking </small>
            </h1>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            EDIT ROOM
        </div>
        <div class="panel-body">
            <form action="{{route('Rooms.update',$room->id)}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" required name="name" value="{{$room->name}}">
                </div>

                <div class="form-group">
                    <label>Room Type</label>
                    <select name="room_type" class="form-control">
                        @foreach($room_type as $item)
                            <option
                                value="{{$item -> id}}" {{$room_type_selected->id == $item->id ? 'selected' : ''}}>{{$item -> name}}</option>
                        @endforeach
                    </select>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Old price</label>
                            <input type="number" value="{{$room ->old_price}}" class="form-control" name="old_price"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New Price</label>
                            <input type="number" value="{{$room -> new_price}}" class="form-control" required
                                   name="new_price">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Feature Image</label>
                    <p class="form-group">
                        <img style="width: 300px;height: 300px" src="{{asset($room->feature_image)}}">
                    </p>
                    <input type="file" name="feature_image" class="form-control-file">
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label>Image detail</label>
                        <p>
                            @foreach($room_image as $item)
                                <img style="width: 200px;height: 200px;margin-right: 20px" src="{{asset($item->image)}}">
                            @endforeach
                        </p>

                        <input class="form-control-file" type="file" name="image[]" multiple="true">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-group">Description</label>
                    <textarea name="description" class="ckeditor" required>{{$room->description}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="number" class="form-control" name="rating" required value="{{$room->rating}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="number_room" class="form-control" required
                                   value="{{$room->number_room}}">
                        </div>
                    </div>
                </div>

                <div class="form-group" style="display: none">
                    <label class="form-group">
                        <input type="text" name="comment_id" class="form-control" value="0">
                        <span>Comment_id</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary form-group">Submit</button>
            </form>
        </div>
    </div>

@endsection
