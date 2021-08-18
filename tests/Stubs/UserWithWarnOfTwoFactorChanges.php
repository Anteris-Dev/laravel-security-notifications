<?php

namespace Anteris\Tests\LaravelSecurityNotifications\Stubs;

use Anteris\LaravelSecurityNotifications\Concerns\WarnsOfTwoFactorChanges;
use Illuminate\Foundation\Auth\User;

class UserWithWarnOfTwoFactorChanges extends User
{
    use WarnsOfTwoFactorChanges;

    protected $table = 'users_with_two_factor';

    protected $guarded = [];
}
