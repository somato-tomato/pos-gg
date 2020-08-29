<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivewireController extends Controller
{
    Public function livewireCart()
    {
        return view('livewire.livewireCart');
    }
}
