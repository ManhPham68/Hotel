@extends('admin.home')

@section('content')

    <div class="row">
        <div class="col-md-6"><h1>Facility manager</h1></div>
        <div class="col-md-6" style="text-align: right">
            <button class="btn btn-danger"><a href="{{route('Facility.create')}}" style="color: white"> Add Facility</a>
            </button>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <div class="col-md-12">
            <div class="row">
                <form class="col-md-2" method="get" action="{{route('Facility.index')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <input class="form-control" style="background-color: #f2f4f6;display: inline" type="text" placeholder="Search" name="name">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-navbar" type="submit" style="display:inline">
                                <i class="fas fa-search"></i>
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

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Destroy</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lsFacility as $facility)
            <tr>
                <td> {{$facility -> id}} </td>
                <td> {{$facility -> name}} </td>
                <td> {{$facility -> type == 0 ? 'Free' : 'Not Free'}} </td>
                <td> {{$facility -> price}} $</td>
                <td> {!! $facility -> description  !!} </td>

                <td>
                    <form method="get" action="{{route('Facility.edit',$facility->id)}}">
                        @csrf
                        <button type="submit" class="btn-success"> Update</button>
                    </form>
                </td>

                <td>
                    <form method="post" action="{{route('Facility.destroy',$facility->id)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')"> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {{ $lsFacility ->appends(['name' => $name]) -> links() }}
@endsection


