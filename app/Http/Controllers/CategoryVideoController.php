<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $videos = $category->videos()
        ->filter($request->all())
        ->paginate(12)
        ->withQueryString();
        
        $videos->load('user', 'category');
        $title = $category->name;
        return view('videos.index', compact('videos', 'title'));
    }
}
