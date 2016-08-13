<?php

namespace StickIt\Http\Controllers;

use StickIt\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * [GET] Sends non logged in users to welcome splash page, logged in users go to their notes manager.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getIndex()
    {
        // Check is user is logged in, if so send them to notes index page
        if (\Auth::check()) return redirect()->action('NoteController@getIndex');

        return view('home.index');
    }
}
