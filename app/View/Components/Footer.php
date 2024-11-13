<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Admin\OptionsService;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public array $options;
    public $pages;
    
    public function __construct(private OptionsService $optionsService)
    {
        $options = $optionsService->getOptionValuesByKeys(['email', 'instagram', 'facebook', 'youtube']);
        $this->pages = Page::get();

        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
