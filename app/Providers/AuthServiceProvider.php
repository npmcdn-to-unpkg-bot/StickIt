<?php

namespace StickIt\Providers;

use StickIt\Color;
use StickIt\Note;
use StickIt\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'StickIt\Model' => 'StickIt\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('edit-note', function (User $user, Note $note)
        {
            return $note->can_edit || $note->can_modify;
        });

        $gate->define('delete-note', function (User $user, Note $note)
        {
            return $note->can_delete;
        });

        $gate->define('share-note', function (User $user, Note $note)
        {
            return $note->can_share;
        });

        $gate->define('delete-color', function (User $user, Color $color)
        {
            return $color->can_delete;
        });
    }
}
