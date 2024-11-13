<?php

namespace App\View\Components;

use App\Enums\OrderableType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavoriteButton extends Component
{
    /**
     * Create a new component instance.
     */

    public int $id;
    public OrderableType $type;

    public function __construct(int $id, OrderableType $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.favorite');
    }
}
