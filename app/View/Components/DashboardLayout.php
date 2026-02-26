<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class DashboardLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $check = Auth::check();

        if (!$check) return view('layouts.public');
        return view('layouts.dashboard');
    }
}
