@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Add data <small> Permission </small>
            </h1>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            ADD NEW PERMISSION
        </div>
        <div class="panel-body">
            <form action="{{route('Permission.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>
                        Name
                    </label>
                    <select name="name" class="form-control">
                        <option value=""></option>
                        <option value="Room">Room</option>
                        <option value="Guest">Guest</option>
                        <option value="Facility">Facility</option>
                        <option value="RoomImage">Room Image</option>
                        <option value="RoomType">Room Type</option>
                        <option value="RoomFacility">Room Facility</option>
                        <option value="Booking">Booking</option>
                        <option value="Slider">Slider</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Display name
                    </label>
                    <input type="text" class="form-control" name="display_name" required>
                </div>

                <div class="panel-body">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <label>
                                <input type="checkbox" value="" id="select_all">
                                Check all
                            </label>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" value="list" name="permissions[]">
                                        List
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" value="add" name="permissions[]">
                                        Add
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" value="edit" name="permissions[]">
                                        Edit
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label>
                                        <input type="checkbox" value="delete" name="permissions[]">
                                        Delete
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <button type="submit" class="btn btn-danger">Submit</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-danger">
            {{session('success')}}
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Parent ID</th>
                        <th>Key Code</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsPermission as $item)
                        <tr>
                            <td> {{$item -> id}} </td>
                            <td> {{$item -> name}} </td>
                            <td> {{$item -> display_name}} </td>
                            <td> {{$item -> parent_id}} </td>
                            <td> {{$item -> key_code}} </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsPermission -> links() }}

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#select_all').click(function (event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $('input[type="checkbox"][name="permissions[]"]').each(function () {
                        this.checked = true;
                    })
                } else {
                    $('input[type="checkbox"][name="permissions[]"]').each(function () {
                        this.checked = false;
                    })
                }
            });
        })
    </script>
@endsection
