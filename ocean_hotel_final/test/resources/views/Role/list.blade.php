@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Role </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: right">
            <button class="btn btn-danger"><a href="{{route('Role.create')}}"
                                              style="color: white;text-decoration: none"> Add Role</a>
            </button>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('Role.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: white;display: inline" type="text"
                                   placeholder="Search" name="name">
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
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Edit</th>
                        <th>Destroy</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsRole as $role)
                        <tr>
                            <td> {{$role -> id}} </td>
                            <td> {{$role -> name}} </td>

                            <td>
                                <form method="get" action="{{route('Role.edit',$role->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"> Update</button>
                                </form>
                            </td>

                            <td>
                                <a class="delete btn btn-danger" data-url="{{route('Role_delete_ajax',$role->id)}}">
                                    Delete
                                </a>
                            </td>

{{--                            <td>--}}
{{--                                <a data-url="{{route('Facility_destroy_ajax',$facility->id)}}"  class="delete btn btn-danger">--}}
{{--                                    Delete--}}
{{--                                </a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsRole -> links() }}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>
    <script>
        $(function () {
            $('.delete').click(function () {
                let urlRequest = $(this).data('url');
                let that = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'GET',
                            url: urlRequest,
                            success: function (data) {
                                if (data.code == 200) {
                                    that.parent().parent().remove();
                                }
                            },
                            error: function () {

                            }
                        });
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                });
            });
        });
    </script>
@endsection
