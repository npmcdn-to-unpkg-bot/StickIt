@extends('layouts.app')

@section('title','Stick It - ' . Auth::user()->name . "'s Notes")

@section('body-id','note-manager-app')

@section('modals')
    @include('notes.partials.create_note_modal')
    @include('notes.partials.edit_note_modal')
    @include('notes.partials.share_note_modal')

@endsection

@section('content')
    <div class="note-page-header">
        @include('layouts.nav')
        @include('notes.partials.nav_notes')
    </div>
    <div class="container-fluid p-a-1 animated loading note-wrapper" id="note-wrapper">
        <div class="alert alert-info text-xs-center" role="alert" v-show="!notes.length">
            <strong>Look at all this room!</strong> This place could use a few notes to brighten up the place. <a
                    href="#" data-toggle="modal" data-target="#createNote"><u>Create New Note</u></a>
        </div>
        <div class="row">
            <div class="col-xs-3 animated" v-for="note in notes | filterBy search" transition="notes">
                <div class="card"
                     v-bind:style="{ backgroundColor: note.color != null ? note.color.hex_color : 'white' }">
                    <div class="card-block">
                        <h4 class="card-title">
                            <div class="pull-xs-right"
                                 v-show="note.can_share || note.can_edit || note.can_delete || note.can_modify">
                                <div class="dropdown">
                                    <div class="cursor" data-toggle="dropdown" aria-haspopup="true"
                                         aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" v-on:click="editNote(note)"
                                           v-show="note.can_edit || note.can_modify">
                                            <i class="fa fa-pencil text-info"></i> Edit</a>
                                        <a class="dropdown-item" href="#" v-on:click="deleteNote(note)"
                                           v-show="note.can_delete">
                                            <i class="fa fa-trash text-danger"></i> Delete</a>
                                        <div class="dropdown-divider" v-show="note.can_share"></div>
                                        <a class="dropdown-item" href="#" v-show="note.can_share"
                                           v-on:click="shareNote(note)">
                                            <i class="fa fa-share-alt text-success"></i> Share</a>
                                    </div>
                                </div>
                            </div>
                            <i class="fa fa-share-alt" v-show="note.shared_note"></i>
                            @{{ note.title }}
                        </h4>
                        <div class="card-text" style="height: 170px;overflow: auto">@{{{ note.description }}}</div>
                        <div class="card-text" style="min-height: 50px;">
                            <div v-show="note.updated_at != note.created_at">
                                <small><i class="fa fa-clock-o"></i> Updated @{{ note.updated_at }}</small>
                            </div>
                            <div v-show="note.share_users.length">
                                <small><i class="fa fa-share-alt"></i> @{{ note.share_users.length }}
                                    Shared @{{ (note.share_users.length > 1) ? 'Users' : 'User' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('scripts')
    <script src="{{ elixir('js/stick.it.note-manager-app.js','/') }}"></script>
@stop