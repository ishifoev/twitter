<?php

namespace App\Tweets\Entities;
use Illuminate\Database\Eloquent\Collection;
use App\User;

class EntityDatabaseCollection extends Collection
{
    /**
     * List of the username Collection
     * @return App\User
     */
    public function users()
    {
        return User::whereIn('username', $this->pluck('body_plain'))->get();
    }
}