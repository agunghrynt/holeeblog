<?php

namespace App\Livewire;

use Livewire\Component;

class CommentManager extends Component
{
    public $post;
    public $comment;
    public $isAdmin;

    protected $listeners = [
        'commentUpdate' => 'updateCommentsCount',
    ];

    public function mount($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function updateCommentsCount()
    {
        $this->post->loadCount('comments');
    }

    public function render()
    {
        $comments = $this->post->comments()->with('author')->get();
        return view('livewire.comment-manager', compact('comments'));
    }
}
