<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class blogController extends Controller
{
    public function index()
        {
            $blog = Blog::orderByDesc('id')->paginate(15);
            return view('content.blog.dashboard', compact('blog'));
        }
}
