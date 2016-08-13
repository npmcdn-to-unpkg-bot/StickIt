<?php

namespace StickIt;

use StickIt\Extensions\Avatar;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * StickIt\User
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_token
 * @property string $email
 * @property boolean $verified
 * @property string $email_token
 * @property boolean $banned
 * @property string $banned_reason
 * @property string $two_factor_token
 * @property string $trust_token
 * @property string $ip_white_list
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User wherePasswordToken($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereEmailToken($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereBannedReason($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereTwoFactorToken($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereTrustToken($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereIpWhiteList($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\Note[] $notes
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\Note[] $share_notes
 * @property string $name
 * @property string $avatar
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereAvatar($value)
 * @property boolean $include_shares
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\Color[] $note_colors
 * @method static \Illuminate\Database\Query\Builder|\StickIt\User whereIncludeShares($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\Note[] $shared_notes
 * @property-read \Illuminate\Database\Eloquent\Collection|\StickIt\Note[] $trash_notes
 * @property-read mixed $avatar_url
 */
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'include_shares'
    ];

    protected $visible = [
        'id',
        'name',
        'email',
        'avatar_url',
        'pivot'
    ];

    protected $appends = [
        'avatar_url'
    ];

    /**
     * Boot function to call event functions
     */
    public static function boot()
    {
        parent::boot();

        // After the user is created... run
        static::created(function (User $user)
        {
            // Insert base example colors into the user
            $user->note_colors()->createMany(Color::base_colors_array());
            // Insert example notes into the user
            $user->notes()->createMany(Note::exampleNotes($user));
        });
    }

    /**
     * Note Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Note Color Relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function note_colors()
    {
        return $this->hasMany(Color::class);
    }

    /**
     * Notes shared to the user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function share_notes()
    {
        return $this->belongsToMany(Note::class);
    }

    /**
     * Notes shared by the user
     * @return mixed
     */
    public function shared_notes()
    {
        return $this->hasMany(Note::class)->with('share_users')->has('share_users');
    }

    /**
     * Trashed Notes Relationship
     * @return mixed
     */
    public function trash_notes()
    {
        return $this->hasMany(Note::class)->onlyTrashed();
    }

    /**
     * Avatar class to handle avatar related responsibilities
     * @return Avatar
     */
    public function avatar()
    {
        return new Avatar($this);
    }

    /**
     * Avatar url attribute to help simplify json output for the users avatar url
     * @return mixed
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar()->url();
    }
}
