<?php

namespace StickIt\Http\Controllers;

use StickIt\Color;
use StickIt\Http\Requests\Color\CreateRequest as ColorCreateRequest;
use StickIt\Http\Requests\Notes\AddShareUserRequest;
use StickIt\Http\Requests\Notes\CreateRequest as NoteCreateRequest;
use StickIt\Http\Requests\Notes\EditRequest;
use StickIt\Http\Requests\Notes\RemoveShareUserRequest;
use StickIt\Note;
use StickIt\User;
use Auth;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * NoteController constructor.
     */
    public function __construct()
    {
        // User must be logged in in order to access this controller
        $this->middleware('auth');
    }

    /**
     * [GET] Display page for all users notes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        // Pulls list of colors for forms
        $colors = Auth::user()->note_colors()->get();

        // Sets "active" navigation link
        $nav_menu = 'notes';

        return view('notes.index', compact('nav_menu', 'colors'));
    }

    /**
     * [GET] Display page fro users trashed notes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDeleted()
    {
        // Sets "active" navigation link
        $nav_menu = 'deleted';

        return view('notes.trash', compact('nav_menu'));
    }

    /**
     * [API/POST] API Handler to create new note
     * @param NoteCreateRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function apiCreate(NoteCreateRequest $request)
    {
        $note = Auth::user()->notes()->create($request->data());

        return $note->load('color', 'share_users');
    }

    /**
     * [API/POST] API Handler for editing note info
     * @param Note $note
     * @param EditRequest $request
     * @return Note $note
     */
    public function apiEdit(Note $note, EditRequest $request)
    {
        // Lazy loads current user's share permissions
        $note->load('auth_user_share');

        // Verifies if user has permissions to edit note
        $this->authorize('edit-note', $note);

        // Updates note data
        $note->update($request->data());

        return $note->load('color', 'share_users');
    }

    /**
     * [API/GET] API Handler for deleting note
     * @param Note $note
     */
    public function apiDelete(Note $note)
    {
        // Verifies if user has permissions to delete note
        $this->authorize('delete-note', $note);

        // Deletes note
        $note->delete();
    }


    /**
     * [API/GET] API Handler for restoring a deleted note
     * @param Note $note
     * @return Note
     */
    public function apiRestore(Note $note)
    {
        // Verifies if user has permissions to delete note
        $this->authorize('delete-note', $note);

        // Restores deleted note
        $note->restore();

        return $note;
    }

    /**
     * [API/GET] API Handler to permanently delete a trashed note
     * @param Note $note
     */
    public function apiPermDelete(Note $note)
    {
        // Verifies if user has permissions to delete note
        $this->authorize('delete-note', $note);

        $note->forceDelete();
    }

    /**
     * [API/GET] API Handler to permanently delete all trashed notes
     */
    public function apiPermDeleteAll()
    {
        // Force Delete on works on single items, cycles through all deleted and fires force delete
        Auth::user()->trash_notes()->get()->each(function (Note $item)
        {
            $item->forceDelete();
        });
    }

    /**
     * [API/POST] API Handler for adding user to shared list for a note
     * @param Note $note
     * @param AddShareUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiAddShare(Note $note, AddShareUserRequest $request)
    {
        // Verifies if user has permissions to share note
        $this->authorize('share-note', $note);

        // Checks if user entered in their own email, calls back error
        if ($request->get('email') == Auth::user()->email)
        {
            return response()->json(['message' => 'You can not add yourself'], 400);
        }

        // Checks if the user has been already added to the share list
        if ($note->share_users()->whereEmail($request->get('email'))->count())
        {
            return response()->json(['message' => 'Already Added'], 400);
        }

        // Pulls the user that needs to be added to the share list
        $user = User::whereEmail($request->get('email'))->where('id', '!=', Auth::id())->firstOrFail();

        // Adjusts pivot "modify" attribute
        $pivot = ['modify' => $request->get('modify')];

        // Adds user to the shared user list with pivot
        $note->share_users()->attach($user, $pivot);

        return response()->json($user->toArray() + ['pivot' => $pivot]);
    }

    /**
     * [API/POST] API Handler to remove user from the share list on a note
     * @param Note $note
     * @param RemoveShareUserRequest $request
     */
    public function apiRemoveShare(Note $note, RemoveShareUserRequest $request)
    {
        // Verifies if user has permissions to share note
        $this->authorize('share-note', $note);

        // Pulls the user that needs to be removed from the share list
        $user = $note->share_users()->whereEmail($request->get('email'))->get();

        // Removes user from the share list
        $note->share_users()->detach($user);
    }


    /**
     * [API/GET] API Handler to pull notes and shared notes
     * User "shares" parameter to include shares with the pull
     * @param Request $request
     * @return mixed
     */
    public function apiList(Request $request)
    {
        // Pulls share parameter to include shares in the callback
        $shares = ($request->input('shares', false) == 'true');

        // Update the users settings to hold on page refresh
        Auth::user()->update(['include_shares' => $shares]);

        // Load current users notes
        $notes = Auth::user()->notes()->get()->load('share_users');

        // If to include shares, load current users shared notes
        if ($shares) return $notes->merge(Auth::user()->share_notes()->get()->load('share_users'));

        return $notes;
    }

    /**
     * [API/GET] API Handler to callback list of trashed notes
     * @return mixed
     */
    public function apiTrash()
    {
        return Auth::user()->trash_notes()->get();
    }

    /**
     * [API/GET] API Handler to callback list of shared notes
     * @return mixed
     */
    public function apiShares()
    {
        return Auth::user()->shared_notes()->get();
    }

    /**
     * [API/GET] API Handler to callback list of users shared on a note
     * @param Note $note
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function apiShareUsers(Note $note)
    {
        // Verifies if user has permissions to share note
        $this->authorize('share-note', $note);

        return $note->share_users()->get();
    }

    /**
     * [API/GET] API Handler to callback list of note colors
     * @return mixed
     */
    public function apiColors()
    {
        return Auth::user()->note_colors()->get();
    }

    /**
     * [API/POST] API Handler to add a new note color
     * @param ColorCreateRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function apiAddColor(ColorCreateRequest $request)
    {
        $color = Auth::user()->note_colors()->create($request->data());

        return $color;
    }

    /**
     * [API/GET] API Handler to delete a note color
     * @param Color $color
     */
    public function apiDeleteColor(Color $color)
    {
        // Verifies if user has permissions to delete note
        $this->authorize('delete-color', $color);

        $color->delete();
    }
}
