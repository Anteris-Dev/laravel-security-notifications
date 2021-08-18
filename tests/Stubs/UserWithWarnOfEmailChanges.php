<?php

namespace Anteris\Tests\LaravelSecurityNotifications\Stubs;

use Anteris\LaravelSecurityNotifications\Concerns\WarnsOfEmailChanges;
use Illuminate\Foundation\Auth\User;

class UserWithWarnOfEmailChanges extends User
{
    use WarnsOfEmailChanges;

    protected $table = 'users';

    protected $guarded = [];
}
