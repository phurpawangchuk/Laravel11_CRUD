<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class AuthenticatedContent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->isAuthenticated = Auth::check();
        $this->user = Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.authenticated-content');
    }
}