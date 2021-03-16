<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tweet extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * Return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
