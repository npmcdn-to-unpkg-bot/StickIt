@extends('layouts.app')

@section('title','Stick It - Profile Settings')

@section('content')
    @include('layouts.nav')
    <img src="../img/banner2.png" class="settings-banner">
    <div class="container p-t-3">
        <div class="row">
            <div class="col-md-4">
                @include('account.partials.nav',['active' => 'profile'])
            </div>
            <div class="col-md-8">
                @include('partials.errors')
                <div class="card">
                    {!! Form::model(Auth::user(),['action'=>'AccountController@postProfileSettings','files'=>true]) !!}
                    <div class="card-header settings-header">
                        <h4 class="card-title"><i class="fa fa-user"></i> Profile Settings</h4>
                        <h6 class="card-subtitle text-muted"><span class="text-danger">*</span> Elements are required
                        </h6>
                    </div>
                    <div class="card-block">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-xs-2 col-form-label">Name<span
                                        class="text-danger">*</span></label>
                            <div class="col-xs-10">
                                {!! Form::text('name',null,['placeholder' => 'Name', 'class' => 'form-control','maxlength'=>'50','required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-xs-2 col-form-label">Email<span
                                        class="text-danger">*</span></label>
                            <div class="col-xs-10">
                                {!! Form::text('email',null,['placeholder' => 'Email', 'class' => 'form-control','maxlength'=>'255','required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-xs-2 col-form-label">Avatar</label>
                            <div class="col-xs-10">
                                <img src="{{ Auth::user()->avatar()->url() }}" class="img-rounded img-responsive m-b-1">
                                @if(Auth::user()->avatar()->has())
                                    <a href="{{ action('AccountController@apiRemoveAvatar') }}"
                                       class="text-danger m-l-2">Remove Avatar</a>
                                @endif
                                {!! Form::file('avatar',['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-xs-right">
                        <button type="submit" class="btn btn-success">Update Details</button>
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