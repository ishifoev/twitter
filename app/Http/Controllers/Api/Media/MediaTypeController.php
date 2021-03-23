<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Media\MimeTypes;

class MediaTypeController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'image' => MimeTypes::$image,
                'video' => MimeTypes::$video
            ]
        ]);
    }
}
