<?php

namespace App\View\Components;

use App\Enums\LessonType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Collection;

class CabinetNavigation extends Component
{
    /**
     * Create a new component instance.
     */
    public $collectionMenuItems;

    public function __construct()
    {
        $this->collectionMenuItems = Collection::where([['unique_template', false]])->whereNot('type', LessonType::ADAPTATION->value)->latest()->take(8)->pluck('title', 'slug');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('cabinet.navigation');
    }
}
