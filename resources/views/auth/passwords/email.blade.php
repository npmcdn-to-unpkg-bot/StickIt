@extends('layouts.full')

@section('content')
    <div class="login-wrapper animated fadeIn">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 offset-md-4 offset-lg-4">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card" style="border: solid 1px #1D2127;">
                <div class="card-header text-xs-center" style="background: #1D2127;">
                    <a href="/">
                        <img src="/img/logo.png" alt="" style="width: 140px;">
                    </a>
                </div>
                <div class="card-block p-b-0">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <p>We are sorry you are having issues with your password. Enter your registered email below and we will get you a reset email out to you in a jiffy.</p>
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
                        <div class="form-group">
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-paper-plane"></i>
                                    <span class="hidden-xs-down">
                                            Send Reset Email
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


<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">



                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
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
