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
                <div class="card-block p-b-0" id="pwd-container">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" maxlength="50" placeholder="Name" required>
                            </div>
                            @if ($errors->has('name'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" maxlength="255" placeholder="Email" required>
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
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" maxlength="64" required>
                            </div>
                            <small class="help-block text-muted">
                                Must contain 1 lower case, 1 upper case, and 1 number, Between 8 - 64 Characters
                            </small>
                            @if ($errors->has('password'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-refresh"></i>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirm" maxlength="64" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-12 col-sm-6 offset-sm-3">
                                {!! Recaptcha::render() !!}
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-xs-8">
                                <small>
                                    By registering you agree with our <a href="#" target="_blank"> Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                                </small>
                            </div>
                            <div class="col-xs-4 text-xs-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i>
                                    <span class="hidden-xs-down">
                                            Register
                                        </span>
                                </button>
                            </div>
                        </div>
                        <hr class="login">
                        <div class="text-xs-center m-b-1">
                            <a href="{{ action('Auth\AuthController@showLoginForm') }}">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
