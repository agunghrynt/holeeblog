<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentList extends Component
{
    public $post;
    public $comment;
    public $isAdmin;

    protected $listeners = [
        'commentUpdate' => 'render',
    ];

    public function mount($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function edit($commentId)
    {
        $this->dispatch('editComment', $commentId);
    }

    public function delete($commentId)
    {
        $this->dispatch('deleteComment', $commentId);
    }

    public function render()
    {
        // $this->post->loadMissing('comments.author');
        return view('livewire.comment-list');
    }
}
