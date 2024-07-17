<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class AddComment extends Component
{
    public $post;
    public $comment;
    public $isAdmin;
    public $commentBody;

    public $isAnonymous = false;
    public $editCommentId = null;

    protected $listeners = [
        'commentUpdate' => 'render',
        'editComment' => 'editComment',
        'deleteComment' => 'deleteComment'
    ];

    protected $rules = [
        'commentBody' => ['required', 'string', 'max:255', 'min:5'],
    ];

    public function mount($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    public function submit()
    {
        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to post a comment.');
            return;
        }
        
        $this->validate();

        try {
            if ($this->editCommentId) {
                $comment = Comment::findOrFail($this->editCommentId);
                $comment->body = $this->commentBody;
                $comment->is_anonymous = $this->isAnonymous;
                $comment->save();
    
                $this->editCommentId = null;
                $this->dispatch('commentUpdate');
            } else {
                // Simpan komentar ke database
                $comment = new Comment();
                $comment->post_id = $this->post->id;
                $comment->user_id = auth()->id();
                $comment->body = $this->commentBody;
                $comment->is_anonymous = $this->isAnonymous;
                $comment->save();
            }

            // Reset input form
            $this->resetForm();

            // Emit event untuk memperbarui komentar
            $this->dispatch('commentUpdate');

            session()->flash('success', 'Comment saved successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving your comment.');
        }
    }

    public function editComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $this->editCommentId = $comment->id;
        $this->commentBody = $comment->body;
        $this->isAnonymous = $comment->is_anonymous;
    }

    public function deleteComment($commentId)
    {
        Comment::destroy($commentId);
        $this->dispatch('commentUpdate');
    }

    public function resetForm()
    {
        $this->commentBody = '';
        $this->isAnonymous = false;
        $this->editCommentId = null;
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
