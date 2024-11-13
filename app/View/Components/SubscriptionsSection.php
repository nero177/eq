<?php

namespace App\View\Components;

use App\Models\Subscription;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\Admin\OptionsService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubscriptionsSection extends Component
{
    /**
     * Create a new component instance.
     */
    public array $options;
    public Subscription|null $subscription;
    public string $lang;

    public function __construct(private OptionsService $optionsService)
    {
        $options = $optionsService->getOptionValuesByKeys(['start_section_desc', 'start_section_subscription']);
        $subscription = Subscription::where('id', $options['start_section_subscription'])->first();
        
        $this->options = $options;
        $this->subscription = $subscription;
        $this->lang = LaravelLocalization::getCurrentLocale();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('sections.subscriptions');
    }
}
