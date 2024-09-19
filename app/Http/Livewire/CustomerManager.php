<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Providers\OpenAIService;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class CustomerManager extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.customer-manager');
    }
}