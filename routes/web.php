<?php

use App\Models\Topic;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Topic::withCount(['courses', 'episodes'])->get();
});
