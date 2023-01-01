<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post, Category, User};

class PostController extends Controller
{
    public function index(Request $request)
    {
        $title = '';

        if ($request->query('category')) {
            $category = Category::firstWhere('slug', $request->query('category'));
            $title = ' in ' . $category->name;
        }

        if ($request->query('author')) {
            $author = User::firstWhere('username', $request->query('author'));
            $title = ' by ' . $author->name;
        }

        return view('posts', [
            'title' => 'All Posts' . $title,
            'active' => 'posts',
            'posts' => Post::latest()->filter($request->all('search', 'category', 'author'))->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'title' => 'Single Post',
            'active' => 'posts',
            'post' => $post
        ]);
    }
}
