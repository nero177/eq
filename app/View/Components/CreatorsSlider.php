<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class CreatorsSlider extends Component
{
    /**
     * Create a new component instance.
     */
    public $authors;

    public function __construct()
    {
        $authors = User::where([['role', User::ROLE_AUTHOR], ['details->show_in_about', 1]])->orderBy('details->order')->get();
        
        $this->authors = $authors;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.creators-slider');
    }
}
