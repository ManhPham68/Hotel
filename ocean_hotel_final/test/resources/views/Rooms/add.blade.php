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
        <div class="alert alert-info">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-primary">
        <div class="panel-heading">
            ADD NEW ROOM
        </div>
        <div class="panel-body">
            <form action="{{route('Rooms.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" required name="name">
                </div>

                <div class="form-group">
                    <label>Room Type</label>
                    <select name="room_type" class="form-control">
                        @foreach($room_type as $item)
                            <option
                                value="{{$item -> id}}">{{$item -> name}}</option>
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
                            <input type="number" class="form-control" name="old_price"
                                   required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New Price</label>
                            <input type="number" class="form-control" required
                                   name="new_price">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Feature Image</label>
                    <input type="file" name="feature_image" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label>Image detail</label>
                        <input class="form-control-file" type="file" name="image[]" multiple="true" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-group">Description</label>
                    <textarea name="description" class="ckeditor" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="number" class="form-control" name="rating" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="number_room" class="form-control" required>
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
