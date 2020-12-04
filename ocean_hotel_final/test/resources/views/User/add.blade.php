@extends('admin.home')
@section('css')
    <style>
        .select2-selection__choice__display{
            background-color: #428bca !important;
            color: white;
            font-size: 16px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> USER </small>
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
            ADD NEW USER
        </div>
        <div class="panel-body">
            <form action="{{route('User.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required value="{{old('name')}}"
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role[]" class="select form-control" multiple required>
                        <option value=""></option>
                        @foreach($lsRole as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    <input type="file" name="avatar" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label>Precept</label>
                    <input type="text" name="precept" class="form-control" required>
                </div>


                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $('select').select2({
            placeholder: 'Role',
            tokenSeparators: [',', ' ']
        });
    </script>
@endsection
