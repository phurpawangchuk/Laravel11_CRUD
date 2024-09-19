<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Student;
use App\Models\User;
use App\Models\Post;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $products = Product::all();
        $students = Student::all();
        $posts = Post::all();
        $users = User::all();
        return view('welcome', compact('users','products','students','posts'));
    }

    public function index()
    {
        return view('welcome', ['posts' => Post::all()]);
    }

    public function showAddComment($postId)
{
    $this->showCommentModal = true;
    $this->selectedPost = $this->posts->find($postId);
}

public function addComment()
{
    $this->validate([
        'newComment' => 'required|min:2',
    ]);

    $comment = new Comment();
    $comment->post_id = $this->selectedPost->id;
    $comment->comment = $this->newComment;
    $comment->save();

    $this->selectedPost->comments()->push($comment);
    $this->newComment = '';
    $this->showCommentModal = false;

    $this->emit('commentAdded');
}
}