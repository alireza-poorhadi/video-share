<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->with('user', 'category')->take(6)->get();
        $mostWatchedVideos = Video::with('user', 'category')->inRandomOrder()->limit(6)->get();
        $mostPopularVideos = Video::with('user', 'category')->filter(['sortBy' => 'like'])->take(6)->get();
        $categories = Category::all();
        return view('index', compact('videos', 'mostWatchedVideos', 'mostPopularVideos', 'categories'));
    }
}
