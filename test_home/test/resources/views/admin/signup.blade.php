<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
    <meta name="author" content="leamug">
    <title>Unique Login Form | Bootstrap Templates</title>
    <link href="{{asset('login_css/style.css')}}" rel="stylesheet" id="style">
    <!-- Bootstrap core Library -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-4 text-center">
            <h1 class='text-white'>Unique Register Form</h1>
            <form method="post" action="{{route('admin.postSignup')}}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="font-size: 18px;font-family: Arial;color: red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-login" style="font-size: 20px"></br>
                    <h4 style="font-size: 20px">Secure Register </h4>
                    </br>
                    <input type="text" class="form-control input-sm chat-input" name="name" placeholder="Name"/>
                    </br></br>
                    <input type="email" class="form-control input-sm chat-input" name="email" placeholder="Email"/>
                    </br></br>
                    <input type="password" class="form-control input-sm chat-input" name="password" placeholder="Password"/>
                    </br></br>
                    <input type="password" class="form-control input-sm chat-input" name="confirm_password" placeholder="Confirm Password"/>
                    </br>
                    @if(\Illuminate\Support\Facades\Session::has('cf_pw'))
                        <p class="alert alert-danger" style="color: red;font-size: 20px;font-family: Arial">
                            {{\Illuminate\Support\Facades\Session::get('cf_pw')}}
                        </p>
                    @endif

                    <div class="wrapper" style="margin-top: 15px">
                            <span class="group-btn">
                                <button class="btn btn-danger btn-md" style="font-size: 20px">Create now <i class="fa fa-sign-in"></i></button>
                            </span>
                    </div>
                    <p style="margin-top: 15px">
                        Not a member ? <a href="{{route('admin.getSignup')}}"> Signup now</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    </br></br></br>
    <!--footer-->
    <div class="footer text-white text-center">
        <p>© 2020 Unique Login Form. All rights reserved | Design by <a href="https://freecss.tech">Huy Duc</a></p>
    </div>
    <!--//footer-->
</div>
</body>
</html>
