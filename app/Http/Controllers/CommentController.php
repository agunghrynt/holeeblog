<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::where('user_id', auth()->id())->with('post')->get();
        return view('user-dashboard.comments.index', [
            'comments' => $comments,
            'isAdmin' => 0
        ]);
    }

    public function manage()
    {
        // Menampilkan semua komentar untuk admin
        $comments = Comment::with('post')->get();
    
        return view('user-dashboard.comments.index', [
            'comments' => $comments,
            'isAdmin' => auth()->user()->isadmin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $isManage = Str::contains(url()->current(), 'manage-comments');
        $comment->post->loadCount(['views', 'comments']);
        $isAdmin = auth()->user()->isadmin;
        return view('user-dashboard.comments.detail', [
            'comment' => $comment,
            'post' => $comment->post,
            'isManage' => $isManage,
            'isAdmin' => $isAdmin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $comment->post->loadCount(['views', 'comments']);
        return view('user-dashboard.comments.edit', [
            'comment' => $comment,
            'post' => $comment->post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Comment::destroy($comment->id);
        return redirect('comments')->with('success', 'Comment has been deleted!');
    }
}
