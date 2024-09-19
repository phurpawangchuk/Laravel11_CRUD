<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Review;

class ReviewManager extends Component
{
    public function render()
    {
        $reviews = Review::all();
        return view('livewire.reviews._index', compact('reviews'));
    }
}
