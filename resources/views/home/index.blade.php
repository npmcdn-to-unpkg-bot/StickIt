@extends('layouts.app')

@section('content')

    <img src="/img/banner.png" style="width: 100%" alt="">
    <div class="m-b-3 container-fluid p-a-1 text-xs-center" style="background: #1D2127;color: white">
        Sign Up Now Its Totally Free <a href="{{ action('Auth\AuthController@showRegistrationForm') }}" class="btn btn-sm btn-primary">Sign Up</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-xs-center">
                <div class="btn btn-circle btn-primary btn-2xl">
                    <i class="fa fa-sticky-note-o fa-3x"></i>
                </div>
                <h4>Manage</h4>
                <p>Manage all your notes in one simple menu. We pride tools and support to stay on top of all your note taking needs.</p>

            </div>
            <div class="col-md-4 text-xs-center">
                <div class="btn btn-circle btn-primary btn-2xl">
                    <i class="fa fa-share-square fa-3x"></i>
                </div>
                <h4>Share</h4>
                <p>Share notes with other users. Control who has access to view or update your notes.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <div class="btn btn-circle btn-primary btn-2xl">
                    <i class="fa fa-tablet fa-3x"></i>
                </div>
                <h4>Multi-Device Support</h4>
                <p>Our services are support across multiple platforms. Giving you on demand access to your note where ever life takes you.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 text-xs-center">
                <div class="btn btn-circle btn-primary btn-2xl">
                    <i class="fa fa-lock fa-3x"></i>
                </div>
                <h4>Security</h4>
                <p>From the browser to the back-end. We pride ourselves to make sure your notes are safe and secure.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <div class="btn btn-circle btn-primary btn-2xl">
                    <i class="fa fa-code fa-3x"></i>
                </div>
                <h4>Framework</h4>
                <p>Our systems are built on top of the world most powerful framework. Giving you the edge to stay ahead of your competition.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <div class="btn btn-circle btn-primary btn-2xl">
                    <i class="fa fa-html5 fa-3x"></i>
                </div>
                <h4>Compliance</h4>
                <p>Staying ahead of industry standards. We make sure your business is ready for the tough road ahead.</p>
            </div>
        </div>
    </div>
@endsection
