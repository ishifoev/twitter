<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/timeline', 'Api\Timeline\TimelineController@index');
Route::post('/tweets', 'Api\Tweets\TweetController@store');