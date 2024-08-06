<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\PostViews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category'))
        {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if(request('author'))
        {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        return view('posts', [
            "title" => "All Posts " . $title,
            "active" => 'posts',
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        $isAdmin = Auth::check() ? Auth::user()->isadmin : false;

        $clientIp = request()->ip();
        PostViews::updateOrCreate([
            'post_id' => $post->id,
            'ip_address' => $clientIp,
        ]);

        $post->loadCount(['views', 'comments']);
        // $post->load('comments.author')->loadCount('comments');

        return view('post', [
            "title" => "Post",
            "active" => 'posts',
            "post" => $post,
            "isAdmin" => $isAdmin,
            "clientIp" => $clientIp,
        ]);
    }
}
