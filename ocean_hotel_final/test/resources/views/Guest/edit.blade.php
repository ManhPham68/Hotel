@extends('admin.home')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Guest <small>Management </small>
            </h1>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            EDIT GUEST
        </div>
        <div class="panel-body">
            <form action="{{route('Guest.update',$guest->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Title</label>
                    <select name="title" class="form-control" required>
                        <option value="Mr" {{$guest->title == 'Mr' ? 'selected' : ''}}>Mr.</option>
                        <option value="Mrs" {{$guest->title == 'Mrs' ? 'selected' : ''}}>Mrs.</option>
                        <option value="Miss" {{$guest->title == 'Miss' ? 'selected' : ''}}>Miss.</option>
                        <option value="Ms" {{$guest->title == 'Ms' ? 'selected' : ''}}>Ms.</option>
                        <option value="Sir" {{$guest->title == 'Sir' ? 'selected' : ''}}>Sir.</option>
                        <option value="Madam" {{$guest->title == 'Madam' ? 'selected' : ''}}>Madam.</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required
                           value="{{$guest->name}}">
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required
                           value="{{$guest->age}}">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" required
                           value="{{$guest->address}}">
                </div>

                <div class="form-group">
                    <label>Telephone</label>
                    <input type="text" name="telephone" class="form-control"
                           required value="{{$guest->telephone}}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required
                           value="{{$guest->email}}">
                </div>

                <div class="form-group">
                    <label>Country</label>
                    <input type="text" name="country" class="form-control" required
                           value="{{$guest->country}}">
                </div>

                <div class="form-group">
                    <label>Comment</label>
                    <textarea name="comment" class="ckeditor"> {{$guest->comments}} </textarea>
                </div>

                <div class="form-group">
                    <label>Avatar</label>
                    <p>
                        <img src="{{asset($guest->avatar)}}" style="width: 300px;height: 300px;border-radius: 5%">
                    </p>

                    <input type="file" name="avatar" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Rating</label>
                    <input type="number" name="rating" class="form-control"
                           value="{{$guest->rating}}">
                </div>

                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>

@endsection
