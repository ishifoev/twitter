<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class TweetMedia extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * Base Media
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function baseMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
