<?php

namespace StickIt;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * StickIt\Note
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereUpdatedAt($value)
 * @property integer $color_id
 * @property-read \StickIt\Color $color
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\User[] $share_users
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\User[] $auth_user_share
 * @property-read mixed $can_modify
 * @property-read mixed $can_edit
 * @property-read mixed $can_delete
 * @property-read mixed $can_share
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Note whereColorId($value)
 * @property-read mixed $shared_note
 */
class Note extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'color_id'
    ];

    protected $visible = [
        'id',
        'title',
        'description',
        'color_id',
        'color',
        'can_edit',
        'can_delete',
        'can_share',
        'can_modify',
        'created_at',
        'deleted_at',
        'updated_at',
        'share_users',
        'shared_note'
    ];

    protected $with = [
        'color',
        'auth_user_share'
    ];

    protected $appends = [
        'can_edit',
        'can_delete',
        'can_share',
        'can_modify',
        'shared_note'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Override for find to allow trashed items
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public static function find($id, $columns = array('*'))
    {
        return parent::withTrashed()->find($id, $columns);
    }

    /**
     * Color Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Users that are shared on this note
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function share_users()
    {
        return $this->belongsToMany(User::class)->withPivot('modify')->withTimestamps();
    }

    /**
     * Only current logged in users share profile
     * @return mixed
     */
    public function auth_user_share()
    {
        return $this->belongsToMany(User::class)->withPivot('modify')->where('user_id', Auth::id());
    }

    /**
     * Modify Permissions Attribute
     * Tells if user can modify note (For Shared Users Only)
     * @return bool
     */
    public function getCanModifyAttribute()
    {
        // Checks if there are any shared user permissions for this user, if not returnes false
        // If they do have permissions, it will return there modify attribute
        return (count($this->auth_user_share)) ? (bool)($this->auth_user_share[0]->pivot->modify) : false;
    }

    /**
     * Edit Permissions Attribute
     * Tells if the user can edit note
     * @return bool
     */
    public function getCanEditAttribute()
    {
        // Are you the owner if the note?
        return Auth::id() == $this->user_id;
    }

    /**
     * Delete Permissions Attribute
     * Tells if the user can delete note
     * @return bool
     */
    public function getCanDeleteAttribute()
    {
        // Are you the owner if the note?
        return Auth::id() == $this->user_id;
    }

    /**
     * Determines if the user is the owner or not.
     * Used as a simple indicator if its a shared note
     * @return bool
     */
    public function getSharedNoteAttribute()
    {
        // Are you the owner if the note?
        return Auth::id() != $this->user_id;
    }

    /**
     * Share Permissions Attribute
     * Tells if the user can share this note
     * @return bool
     */
    public function getCanShareAttribute()
    {
        // Are you the owner if the note?
        return Auth::id() == $this->user_id;
    }

    /**
     * Mutator to cleanse scripts and allow next line breaks for the description
     * @param $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return nl2br(e($value));
    }

    public function setColorIdAttribute($value)
    {
        $this->attributes['color_id'] = (!$value == '') ? $value : null;
    }

    /**
     * Generator for example notes when a new user is created.
     * @param User $user
     * @return array
     */
    public static function exampleNotes(User $user)
    {
        // Pulls the first color in the color relationship
        $color = $user->note_colors()->first();

        return [
            [
                'title'       => 'Example Note #1',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.'
            ],
            [
                'title'       => 'Example Note #2',
                'description' => 'You have the ability to change the color of the note',
                'color_id'    => $color->id
            ],
        ];
    }
}
