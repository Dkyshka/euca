<?php

namespace App\View\Components;

use App\Models\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdsBanner extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Section $section)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ads-banner');
    }
}
