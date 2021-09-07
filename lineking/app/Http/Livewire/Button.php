<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Requested\Show;

class Button extends Component
{
    public $type;

    public function requested()
    {
        return redirect()->route('requested');
    }

    public function reserved()
    {
        return redirect()->route('reserved');
    }

    public function completed()
    {
        return redirect()->route('completed');
    }

    public function render()
    {
        return view('livewire.button');
    }
}