
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('public/assets/'.AD .'/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('public/assets/'.AD .'/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('public/assets/'.AD .'/bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/assets/'.AD .'/dist/css/AdminLTE.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('public/assets/'.AD .'/plugins/iCheck/square/blue.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <style type="text/css">

            .login-page{
                background: url('public/assets/Administrator/dist/img/Splash.jpg') no-repeat;
                background-size: cover;
                overflow: hidden !important;
                margin: 40vh auto;

            }

            .login-box{
                width: 500px;
            }

            @media (max-width:576px){
                .login-box{
                    width: 90%;
                }

            }

            .navbar-expand-lg{
                position: absolute;
                width: 100%;
                top: 0;
                left: 0;
                background-color: #000;
            }
            .navbar-expand-lg h2{

                color: #bb8d3e !important;
                -webkit-text-stroke: 1px #fff;
                -moz-text-stroke: 1px #fff;
                -ms-text-stroke: 1px #fff;
                -o-text-stroke: 1px #fff;
                text-stroke: 1px #fff;
                text-transform: uppercase;
                font-size: 40px;
                font-weight: bolder;
                padding: 10px;
                letter-spacing: 2px;
                width: 300px;
                margin: 0;
                margin-left: auto;
                margin-right: auto;
                padding:20px 0 20px 0;
            }
            .navbar-brand-one img{
                width: 200px;
                padding: 20px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
            @media (max-width:576px){
                .navbar-expand-lg h2{
                    float: left;
                }
                .navbar-brand-one img{
                    text-align: center;
                }
            }

            }

            .login-box .form-group > label{
                margin-top:7px;
            }
            .login-box-msg{
                text-transform: uppercase;
                font-weight: bold;
                font-size: 16px;
                letter-spacing: 1px;
            }
            .btn-block{
                background-color:#bb8d3f !important;
                border-color: #bb8d3f !important;
                color: #fff;
            }
            .btn:hover,
            .btn:active,
            .btn:focus
            {
                background-color: #d2ad6d !important;
                border-color: #d2ad6d !important;
                color: #fff !important;
            }

            .login-box-body{
                box-shadow: 2px 2px 10px rgba(68, 68, 68, 0.60),
                    -2px -2px 10px rgba(68, 68, 68, 0.60);

            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand-one text-center" href="#">
                    <!--<img src="public/assets/Administrator/dist/img/kids-white.png">-->
                </a>
            </div>

        </div>
        <div class="login-box">
            <div class="login-logo">
                <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in</p>

                {!! Form::open(['url'=>'admin/admin_login', 'class'=>'login-form']) !!}
                @if(Session::has('error_login'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{ session()->get('error_login') }}</span>
                </div>
                @endif
                <div class="form-group row has-feedback">
                    <label for="lgFormGroupInput" class="col-sm-3 col-form-label col-form-label-lg">Email</label>
                    <div class="col-sm-9">
                        {!! Form::email('email', old('email'), array('class'=>'form-control','placeholder'=>'Email', 'id' => 'loginEmailInput')) !!}
                        @if ($errors->has('email'))
                        <span class="glyphicon glyphicon-envelope form-control-feedback">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row has-feedback">
                    <label for="lgFormGroupInput" class="col-sm-3 col-form-label col-form-label-lg">Password</label>

                    <div class="col-sm-9">
                        {!! Form::password('password', array('class'=>'form-control','placeholder'=>'Password', 'id' => 'loginPasswordInput')) !!}
                        @if ($errors->has('password'))
                        <span class="glyphicon glyphicon-lock form-control-feedback">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn  btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                {!! Form::close() !!}

                <!-- <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div> -->
                <!-- /.social-auth-links -->
              <!--   <a  href="{{ route('password.request') }}">I forgot my password</a> -->
                <br>
                <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="{{ asset('public/assets/'.AD .'/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('public/assets/'.AD .'/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{ asset('public/assets/'.AD .'/plugins/iCheck/icheck.min.js')}}"></script>
        <script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
        </script>
    </body>
</html>
