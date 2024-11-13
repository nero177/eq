<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Banner;
use App\Models\Collection;

class BannerSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $banners;

    public function __construct($show = ['main'])
    {
        if (! is_array($show)) {
            $show = [$show];
        }

        $banners = Banner::whereJsonContains('show_in', $show)->orderBy('order')->get();

        foreach ($banners as $key => $banner) {
            if (!isset($banner->details['show_on_locales']) || ! in_array(get_current_locale(), $banner->details['show_on_locales'])) {
                $banners->forget($key);
                continue;
            }

            $collection = Collection::find($banner->details['collection_id']);
            $banner->setRelation('collection', $collection);
        }

        $this->banners = $banners;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render() : View|Closure|string
    {
        return view('components.banner-section');
    }
}
