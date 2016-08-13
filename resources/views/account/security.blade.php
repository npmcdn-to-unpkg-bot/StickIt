@extends('layouts.app')

@section('title','Stick It - Security Settings')

@section('content')
    @include('layouts.nav')
    <img src="../img/banner2.png" class="settings-banner">
    <div class="container p-t-3">
        <div class="row">
            <div class="col-md-4">
                @include('account.partials.nav',['active' => 'security'])
            </div>
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card">
                    {!! Form::open(['action'=>'AccountController@postSecuritySettings']) !!}
                    <div class="card-header settings-header">
                        <h4 class="card-title">Change Password</h4>
                        <h6 class="card-subtitle text-muted"><span class="text-danger">*</span> All Elements Required
                    </div>
                    <div class="card-block">
                        <h5>Your password must contain:</h5>
                        <ul>
                            <li>Between 8 - 64 Characters</li>
                            <li>1 Lower Case Character</li>
                            <li>1 Upper Case Character</li>
                            <li>1 Number</li>
                        </ul>
                        <div class="form-group">
                            {!! Form::password('current_password',['placeholder' => 'Current Password', 'class' => 'form-control','maxlength'=>'64','required']) !!}
                            @if ($errors->has('current_password'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::password('password',['placeholder' => 'New Password', 'class' => 'form-control','maxlength'=>'64','required']) !!}
                            @if ($errors->has('password'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </small>
                            @endif

                        </div>
                        <div class="form-group">
                            {!! Form::password('password_confirmation',['placeholder' => 'Confirm Password', 'class' => 'form-control','maxlength'=>'64','required']) !!}
                            @if ($errors->has('password_confirmation'))
                                <small class="help-block text-danger">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </small>
                            @endif

                        </div>
                    </div>
                    <div class="card-footer text-xs-right">
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('scripts')

@stop