@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <img src="/img/banner.png" style="width: 100%" alt="">
    <div class="m-b-3 container-fluid p-a-1 text-xs-center" style="background: #1D2127;color: white">
        Sign Up Now. It's Totally Free. <a href="{{ action('Auth\AuthController@showRegistrationForm') }}"
                                           class="btn btn-sm btn-success m-l-1">Sign Up</a>
    </div>
    <div class="container">
        <div class="row m-b-3">
            <div class="col-md-4 text-xs-center">
                <i class="fa fa-sitemap fa-3x text-success"></i>
                <h4>Manage</h4>
                <p>Manage all your notes in one simple menu. Color code. Search by keyword or color. We enable you to
                    stay on top of all your note taking needs.</p>

            </div>
            <div class="col-md-4 text-xs-center">
                <i class="fa fa-share-alt fa-3x text-success"></i>
                <h4>Share</h4>
                <p>We enable collaboration. Share notes with other users. Control who has access to view and/or edit
                    your notes.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <i class="fa fa-tablet fa-3x text-success"></i>
                <h4>Compatible</h4>
                <p>Tested on all of today's most popular desktop and mobile browsers, giving you on demand access to
                    your notes where ever life takes you.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 text-xs-center">
                <i class="fa fa-shield fa-3x text-success"></i>
                <h4>Security</h4>
                <p>From the browser to the back-end, we pride ourselves on ensuring your notes are safe and secure.</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <i class="fa fa-dollar fa-3x text-success"></i>
                <h4>Free</h4>
                <p>Did we mention it's free? What do you have to lose?</p>
            </div>
            <div class="col-md-4 text-xs-center">
                <i class="fa fa-smile-o fa-3x text-success"></i>
                <h4>Intuitive</h4>
                <p>I mean, have you seen our site? We think Stick It is pretty slick, and we're confident you will
                    too.</p>
            </div>
        </div>
    </div>
@endsection
