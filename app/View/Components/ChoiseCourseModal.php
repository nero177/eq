<?php

namespace App\View\Components;

use App\Models\Subscription;
use App\Models\Collection;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChoiseCourseModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $collections;

    public function __construct()
    {
        $this->collections = Collection::take(30)->where('modal_details->show_in_modal', 1)->get()->sortBy(function ($collection) {
            return (int) $collection->modal_details['order'];
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render() : View|Closure|string
    {
        return view('modals.choise_course');
    }
}
