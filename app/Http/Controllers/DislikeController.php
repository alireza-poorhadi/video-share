<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DislikeController extends Controller
{
    public function store(string $likeable_type, $likeable_id)
    {
        # $likeable_id gets the object of the likeable model from route service provider
        $likeable_id->dislikedBy(auth()->user());
        return back();
    }
}
