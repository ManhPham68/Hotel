@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Slider </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: right">
            <button class="btn btn-danger"><a href="{{route('Slider.create')}}"
                                              style="color: white;text-decoration: none"> Add Slider</a>
            </button>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('Slider.index')}}">
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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Destroy</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lsSlider as $item)
                        <tr>
                            <td> {{$item -> id}} </td>
                            <td> {{$item -> name}} </td>
                            <td> {!! $item -> description !!}</td>
                            <td><img src="{{asset($item->image)}}" style="width: 300px;height: 250px;border-radius: 5%">
                            </td>


                            <td>
                                <form method="get" action="{{route('Slider.edit',$item->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-success"> Update</button>
                                </form>
                            </td>

                            <td>
                                <a data-url="{{route('Slider_destroy_ajax',$item->id)}}" class="delete btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    {{ $lsSlider->appends(['name' => $name]) -> links() }}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('Admin/assets/js/delete_ajax.js')}}"></script>
@endsection
