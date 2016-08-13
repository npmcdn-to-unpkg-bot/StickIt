@extends('layouts.app')

@section('title','Stick It - Note Settings')

@section('content')
    @include('layouts.nav')
    <img src="../img/banner2.png" class="settings-banner">
    <div class="container p-t-3">
        <div class="row">
            <div class="col-md-4">
                @include('account.partials.nav',['active' => 'note'])
            </div>
            <div class="col-md-8">
                <div class="card">
                    {!! Form::model(Auth::user(),['action'=>'AccountController@postProfileSettings','files'=>true]) !!}
                    <div class="card-header settings-header">
                        <h4 class="card-title m-b-0">Color Settings</h4>
                    </div>
                    <div class="card-block">
                        <p class="card-text">Customize your note colors. Have as many as you like, skies the limit!</p>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" v-model="new_color.display_name" class="form-control" maxlength="25" required>
                            </div>
                            <div class="col-xs-4">
                                <div class="input-group colorpicker-component" id="colorpicker-component">
                                    <input type="text" class="form-control" maxlength="7" required/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                            <div class="col-xs-2 text-xs-center">
                                <a class="btn btn-primary" v-on:click="submitNewColor"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" v-for="color in colors" transition="color">
                            <div class="row">
                                <div class="col-xs-6">
                                    @{{ color.display_name }}
                                </div>
                                <div class="col-xs-5 text-xs-right">
                                    <i class="fa fa-square btn btn-link" v-bind:style="{ color: color.hex_color }"
                                       title="@{{ color.hex_color }}"></i>
                                </div>
                                <div class="col-xs-1">
                                    <i class="fa fa-remove text-danger pull-xs-right m-l-1 btn btn-link"
                                       v-on:click="deleteColor(color)"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('scripts')
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

        Vue.transition('color', {
            enterClass: 'fadeIn',
            leaveClass: 'fadeOut'
        });

        new Vue({
            el: '#app-layout',

            data: {
                colors: [],
                new_color: {
                    display_name: '',
                    hex_color: '#000000'
                }
            },

            ready: function () {
                var self = this;

                this.$http.get('/api/colors').then(function (response) {
                    this.colors = response.json();
                }, function () {
                    alert('Something Went Wrong');
                });

                $('#colorpicker-component').colorpicker({color: '#000000'}).on('changeColor', function (e) {
                    self.new_color.hex_color = e.color.toHex();
                });
            },

            methods: {
                submitNewColor: function () {
                    this.$http.post('/api/colors/create', this.new_color).then(function (response) {
                        this.colors.push(response.json());
                        this.clearNewColor();
                    }, function () {
                        alert('Something Went Wrong');
                    });
                },
                clearNewColor: function () {
                    this.new_color = {
                        display_name: '',
                        hex_color: ''
                    }
                },
                deleteColor: function (color) {
                    this.$http.get('/api/colors/delete/' + color.id).then(function (response) {
                        this.colors.$remove(color);
                    }, function () {
                        alert('Something Went Wrong');
                    });
                }
            }
        });
    </script>
@stop