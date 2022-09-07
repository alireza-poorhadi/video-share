<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(string $likeable_type, $likeable_id)
    {
        # $likeable_id gets the object of the likeable model from route service provider
        $likeable_id->likedBy(auth()->user());
        return back();
    }
}
