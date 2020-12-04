@extends('admin.home')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                ADMINISTRATOR <small> accounts </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: right">
            <button class="btn btn-danger"><a href="{{route('User.create')}}"
                                              style="color: white;text-decoration: none"> Add User</a>
            </button>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('User.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: white;display: inline" type="text"
                                   placeholder="Search by name" name="name">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-navbar" type="submit" style="display:inline">
                                <i class="fa fa-search" style="font-size: 20px;background-color: #e5ebf2"></i>
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
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Avatar</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsUsers as $item)
                        <tr>
                            <td> {{$item -> id}} </td>
                            <td> {{$item -> name}} </td>
                            <td> {{$item -> email}} </td>
                            <td>
                                @foreach($item->roles as $role)
                                    {{ '- ' .$role->name}} <br><br>
                                @endforeach
                            </td>
                            <td><img src="{{asset($item -> avatar)}}"
                                     style="border-radius: 50%;height: 250px;width: 250px;"></td>
                            <td>

                                <a data-url="{{route('User_destroy_ajax',$item->id)}}" class="delete btn btn-danger">
                                    Delete
                                </a>
                                <form style="margin-top: 15px" method="get" action="{{route('User.edit',$item->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"> Edit
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsUsers->appends(['name'=>$name])-> links() }}
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>
@endsection


