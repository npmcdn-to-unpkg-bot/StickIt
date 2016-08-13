<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Auth Routes
Route::auth();

// Base Routes
Route::get('/', 'HomeController@getIndex');

// Color Routes
Route::get('/api/colors', 'NoteController@apiColors');
Route::post('/api/colors/create', 'NoteController@apiAddColor');
Route::get('/api/colors/delete/{color}', 'NoteController@apiDeleteColor');

// Note Routes
Route::get('/notes', 'NoteController@getIndex');
Route::get('/notes/deleted', 'NoteController@getDeleted');

// Note API Routes
Route::get('/api/notes', 'NoteController@apiList');
Route::get('/api/notes/trash', 'NoteController@apiTrash');
Route::get('/api/notes/shares', 'NoteController@apiShares');
Route::get('/api/share_notes', 'NoteController@apiShareList');
Route::post('/api/notes/create', 'NoteController@apiCreate');
Route::get('/api/notes/delete/{note}', 'NoteController@apiDelete');
Route::get('/api/notes/share/{note}/list', 'NoteController@apiShareUsers');
Route::post('/api/notes/share/{note}/add', 'NoteController@apiAddShare');
Route::post('/api/notes/share/{note}/remove', 'NoteController@apiRemoveShare');
Route::get('/api/notes/perm/all', 'NoteController@apiPermDeleteAll');
Route::get('/api/notes/perm/{note}', 'NoteController@apiPermDelete');
Route::post('/api/notes/edit/{note}', 'NoteController@apiEdit');
Route::get('/api/notes/restore/{note}', 'NoteController@apiRestore');

// Settings Routes
Route::get('/settings/profile', 'AccountController@getProfileSettings');
Route::post('/settings/profile', 'AccountController@postProfileSettings');
Route::get('/settings/security', 'AccountController@getSecuritySettings');
Route::post('/settings/security', 'AccountController@postSecuritySettings');
Route::get('/settings/notifications', 'AccountController@getNoteSettings');
Route::post('/settings/notifications', 'AccountController@postNoteSettings');
Route::get('/settings/avatar/remove', 'AccountController@apiRemoveAvatar');

