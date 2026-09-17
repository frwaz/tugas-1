<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    // Diubah dari 'layouts.app' menjadi 'layouts.authenticated' supaya
    // <x-app-layout> tidak bentrok dengan resources/views/layouts/app.blade.php
    // yang sudah dipakai untuk layout situs publik di starter ini.
    public function render(): View
    {
        return view('layouts.authenticated');
    }
}
