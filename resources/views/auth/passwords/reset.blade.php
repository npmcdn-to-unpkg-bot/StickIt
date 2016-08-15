@extends('layouts.full')

@section('content')
    <div class="login-wrapper animated fadeIn">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 offset-md-4 offset-lg-4">
            <div class="card" style="border: solid 1px #1D2127;">
                <div class="card-header text-xs-center" style="background: #1D2127;">
                    <a href="/">
                        <img src="/img/logo.png" alt="" style="width: 140px;">
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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" maxlength="255" required>
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
                            <small class="help-block text-muted">
                                Must contain 1 lower case, 1 upper case, and 1 number, Between 8 - 64 Characters
                            </small>
                            @if ($errors->has('password'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-refresh"></i>
                                </div>
                                <input id="password" type="password" class="form-control" name="password_confirmation"
                                       placeholder="Confirm Password" maxlength="64" required>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-key"></i>
                                    <span class="hidden-xs-down">
                                            Reset Password
                                        </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('dsfgsdfgsdfg')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
