<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnnouncementWidget extends Component
{
    public $announcements;

    public function __construct($announcements)
    {
        $this->announcements = $announcements;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.announcement-widget');
    }
}
