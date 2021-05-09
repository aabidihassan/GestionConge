<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLogo extends Component
{
    public $logo;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->logo = GeneralSettings::first()->favicon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.home.app-logo');
    }
}
