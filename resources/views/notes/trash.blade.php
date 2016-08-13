@extends('layouts.app')

@section('title','Stick It - ' . Auth::user()->name . "'s Notes")

@section('body-id','note-trash-app')

@section('modals')

@endsection

@section('content')
    <div class="note-page-header">
        @include('layouts.nav')
        @include('notes.partials.nav_delete')
    </div>
    <div class="container-fluid p-a-1 animated loading note-wrapper" id="note-wrapper">
        <div class="alert alert-success text-xs-center" role="alert" v-show="!notes.length">
            <strong>All Clean!</strong> No need to take out the trash.
        </div>
        <ul class="list-group">
            <li class="list-group-item animated"  v-for="note in notes" transition="notes">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-square" v-bind:style="{ color: note.color != null ? note.color.hex_color : 'white' }"></i>
                        @{{ note.title }}
                    </div>
                    <div class="col-xs-6 text-truncate">
                        @{{ note.description }}
                    </div>
                    <div class="col-xs-3 text-xs-right">
                        <a href="#" class="btn btn-success btn-sm" v-on:click="restoreNote(note)">Restore</a>
                        <a href="#" class="btn btn-danger btn-sm" v-on:click="permDelete(note)">Permanently Delete</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@stop

@section('css')

@stop

@section('scripts')
    <script src="{{ elixir('js/stick.it.note-trash-app.js','/') }}"></script>
@stop