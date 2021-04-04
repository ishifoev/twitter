<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tweets\Entities\EntityDatabaseCollection;

class Entity extends Model
{
    protected $guarded = [];
    
    /**
     * Return a new collection
     * @param array $models
     * @return App\Tweets\Entities\EntityDatabaseCollection
     */
    public function newCollection(array $models = []) {
        return new EntityDatabaseCollection($models);
    }
}
