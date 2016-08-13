<?php

namespace StickIt;

use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * StickIt\Color
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $display_name
 * @property string $hex_color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Color whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Color whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Color whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Color whereHexColor($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\StickIt\Color whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $can_delete
 */
class Color extends Model
{
    protected $fillable = [
        'display_name',
        'hex_color'
    ];

    protected $visible = [
        'display_name',
        'hex_color',
        'id'
    ];

    /**
     * (True/False) Attribute to set permissions to delete color
     * @return bool
     */
    public function getCanDeleteAttribute()
    {
        // Check is the user is owner of the color.
        return Auth::id() == $this->user_id;
    }

    /**
     * Generator for base colors when new user registers
     * @return array
     */
    public static function base_colors_array()
    {
        return [
            [
                'display_name' => 'Green',
                'hex_color'    => '#46be8a'
            ],
            [
                'display_name' => 'Red',
                'hex_color'    => '#f96868'
            ],
            [
                'display_name' => 'Blue',
                'hex_color'    => '#62a8ea'
            ],
            [
                'display_name' => 'Orange',
                'hex_color'    => '#f2a654'
            ],
            [
                'display_name' => 'Teal',
                'hex_color'    => '#57c7d4'
            ]
        ];
    }

}
