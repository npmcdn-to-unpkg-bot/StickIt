@extends('layouts.full')

@section('content')
    <div class="login-wrapper animated fadeIn">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 offset-md-4 offset-lg-4">
            <div class="card" style="border: solid 1px #1D2127;">
                <div class="card-header text-xs-center" style="background: #1D2127;">
                    <a href="/">
                        <img src="../img/logo.png" alt="" style="width: 140px;">
                    </a>
                </div>
                <div class="card-block p-b-0">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" placeholder="Email" maxlength="255" required>
                            </div>
                            @if ($errors->has('email'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                       placeholder="Password" maxlength="64" required>
                            </div>
                            <div class="text-xs-right">
                                <a href="{{ action('Auth\PasswordController@reset') }}">
                                    Forgot Password?
                                </a>
                            </div>
                            @if ($errors->has('password'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div class="checkbox abc-checkbox">
                                    <input id="remember" name="remember" class="styled" type="checkbox">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6 text-xs-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-sign-in"></i>
                                    <span class="hidden-xs-down">
                                            Login
                                        </span>
                                </button>
                            </div>
                        </div>
                        <hr class="login">
                        <div class="text-xs-center m-b-1">
                            <a href="{{ action('Auth\AuthController@showRegistrationForm') }}">Don't have an account?
                                Register Now!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sdgergse')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
