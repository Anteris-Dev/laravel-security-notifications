<?php

namespace Anteris\Tests\LaravelSecurityNotifications\Stubs;

use Anteris\LaravelSecurityNotifications\Concerns\WarnsOfPasswordChanges;
use Illuminate\Foundation\Auth\User;

class UserWithWarnOfPasswordChanges extends User
{
    use WarnsOfPasswordChanges;

    protected $table = 'users';

    protected $guarded = [];
}
