@extends('admin.home')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">
                Management <small> Role </small>
            </h1>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            ADD NEW ROLE
        </div>
        <div class="panel-body">
            <form action="{{route('Role.update',$role->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{$role->name}}" required>
                </div>

                <div class="form-group">
                    <label>Display Name</label>
                    <input type="text" name="display_name" value="{{$role->display_name}}" class="form-control"
                           required>
                </div>
                <div class="form-group">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            PERMISSION ROLE
                        </div>
                        <label style="padding: 20px">
                            <input type="checkbox" id="select_all" class="checkbox_wrapper">
                            All
                        </label>
                        <div class="panel-body">
                            @foreach($lsPermission as $value)
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <label>
                                            <input type="checkbox" value="{{$value}}" name="check_all"
                                                   class="checkbox_wrapper">
                                            {{$value->name}}
                                        </label>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            @foreach($value->Permission_childrent as $item)
                                                <div class="col-md-3">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]" {{$lsPermission_Role->contains('id',$item->id) ? 'checked' : ''}} class="checkbox_childrent" value="{{$item->id}}">
                                                        {{$item->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>


                <button type="submit" class="btn btn-danger">Submit</button>

            </form>
        </div>
    </div>

@endsection
@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.checkbox_wrapper').on('click', function () {
                $(this).parents('.panel-info').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
            })

            $('#select_all').click(function (event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $('input[type="checkbox"][name="check_all"]').each(function () {
                        this.checked = true;
                    });
                    $('input[type="checkbox"][class="checkbox_childrent"]').each(function () {
                        this.checked = true;
                    })
                } else {
                    $('input[type="checkbox"][name="check_all"]').each(function () {
                        this.checked = false;
                    });
                    $('input[type="checkbox"][class="checkbox_childrent"]').each(function () {
                        this.checked = false;
                    })
                }
            });
        })
    </script>
@endsection
