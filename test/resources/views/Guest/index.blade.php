@extends('admin.home')
@section('css')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Email <small> for Guest </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h3 style="margin-bottom: 60px">Send The News Letters to Followers</h3>
                <div class="panel-body">
                    <button class="btn btn-primary btn" data-toggle="modal" data-target="#myModal">
                        Send New News Letters
                    </button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Compose News Letter</h4>
                                </div>
                                <div class="form">
                                    <form>
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input id="title" class="form-control"
                                                       placeholder="Enter Title">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Guest Email</label>
                                                <input id="email" class="form-control"
                                                       placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="comment">Contents</label>
                                                <textarea class="form-control" rows="5"
                                                          id="contents"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="loader" style="display: none"></div>
                                        </div>

                                        <div class="modal-body">
                                            <div class="sent-message"
                                                 style="display: none;padding-left: 15px;color: red;font-size: 20px">
                                                Your message has been sent !
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>

                                            <button type="button" class="btn btn-primary" id="sendMailNofy">Send
                                                Message
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="col-md-2" method="get" style="margin-bottom: 20px;padding-left: 0"
                          action="{{route('Guest.index')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input class="form-control"
                                       style="background-color: white;display: inline"
                                       type="text" placeholder="Search by Name" name="name">
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lsGuest as $guest)
                                <tr>
                                    <td> {{$guest->id}} </td>
                                    <td> {{$guest->title}} </td>
                                    <td> {{$guest->name}} </td>
                                    <td> {{$guest->age}} </td>
                                    <td> {{$guest->address}} </td>
                                    <td> {{$guest->telephone}} </td>
                                    <td> {{$guest->email}} </td>
                                    <td> {{$guest->country}} </td>
                                    <td>
                                        <a class="delete btn btn-danger"
                                           data-url="{{route('Guest_destroy_ajax',$guest->id)}}"> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{$lsGuest->appends(['name'=>$name])->links()}}
                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sendMailNofy').click(function () {
                $('.loader').show();
                var data = {
                    "email": $('#email').val(),
                    "_token": $('#token').val(),
                    "title": $('#title').val(),
                    "contents": $('#contents').val()
                };
                $.ajax({
                    type: "POST",
                    url: "../api/send-email",
                    data: data,
                    success: function (response) {
                        $('.loader').hide();
                        $('.sent-message').show();
                    },
                    error: function (response) {
                        $('.loader').hide();
                        alert(response.responseText);
                    }
                })
            });
        });
    </script>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>
@endsection
