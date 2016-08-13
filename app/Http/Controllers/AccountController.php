<?php

namespace StickIt\Http\Controllers;

use StickIt\User;
use Auth;
use Illuminate\Http\Request;

use StickIt\Http\Requests;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        // User must be logged in in order to access this controller
        $this->middleware('auth');
    }

    /**
     * [GET] Users profile settings page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfileSettings()
    {
        return view('account.profile');
    }

    /**
     * [POST] Request handler for users profile settings
     * @param Requests\Settings\ProfileRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postProfileSettings(Requests\Settings\ProfileRequest $request)
    {
        // Check if the form was submitted with a new avatar file
        if ($request->hasFile('avatar'))
        {
            // Upload avatar using fiel sent with request form
            Auth::user()->avatar()->add($request->file('avatar'));
        }

        // Check if the user sent a new email different from their current, if so check if it is being used by another user.
        if (Auth::user()->email != $request->get('email') && User::whereEmail($request->get('email'))->count())
        {
            // If being used by another, return back error message
            return redirect()->withErrors(['email' => 'That email is already used by another user'])->back();
        }

        // Update users info
        Auth::user()->update($request->only('name', 'email'));

        // Send back success message.
        alert()->success('Your settings have been successfully updated.', 'Updated');

        return redirect()->back();
    }

    /**
     * [GET] User Security settings page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSecuritySettings()
    {
        return view('account.security');
    }

    /**
     * [POST] Request handler for users security settings
     * @param Requests\Settings\SecurityRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postSecuritySettings(Requests\Settings\SecurityRequest $request)
    {
        if (!\Hash::check($request->get('current_password'), Auth::user()->password))
        {
            return redirect()->withErrors(['current_password' => 'Current Password is incorrect'])->back();
        }

        Auth::user()->update($request->only('password'));

        alert()->success('Your password has been successfully changed.', 'Password Changed');

        return redirect()->back();
    }

    /**
     * [GET] User note settings page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNoteSettings()
    {
        return view('account.note');
    }

    /**
     * [API/GET] Removes user avatar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apiRemoveAvatar()
    {
        Auth::user()->avatar()->remove();

        return redirect()->back();
    }
}
