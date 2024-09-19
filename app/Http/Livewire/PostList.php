<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Post;
use App\Models\Review;

class PostList extends Component
{
    public $posts;
    public $showCommentModal = false;
    public $selectedPost;
    public $newComment;

    public function mount()
    {
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.post-list');
    }

    public function showAddComment($postId)
    {
        $this->showCommentModal = true;
        $this->selectedPost = $this->posts->find($postId);

        $post = Post::findOrFail($postId);
        $comments = $post->comments;
    }

        
    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:2',
        ]);

        $review = new Review();
        $review->post_id = $this->selectedPost->id;
        $review->user_id = auth()->id();
        $review->comment = $this->newComment;
        $review->save();

        session()->flash('message', 'Comment submitted successfully.');

        $this->resetFields();

    }

    public function resetFields(){
        $this->newComment = '';
        $this->showCommentModal = false;
    }

    public function close()
    {
        $this->showCommentModal = false;
        $this->newComment = '';
    }

    }