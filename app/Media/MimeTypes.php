<?php

namespace App\Media;

class MimeTypes
{
    /**
     * Image type
     * @var array
     */
    public static $image = [
        'image/png',
        'image/jpg',
        'image/jpeg'
    ];
    /**
     * Video type
     * @var array
     */
    public static $video = [
        'video/mp4'
    ];

    /**
     * Return type
     * @var array
     */
    public static function type($mime)
    {
        if (in_array($mime, self::$image)) {
            return 'image';
        }

        if (in_array($mime, self::$video)) {
            return 'video';
        }

        return null;
    }

    /**
     * Merge video and image type
     * @var array
     */
    public static function all()
    {
        return array_merge(self::$image, self::$video);
    }
}