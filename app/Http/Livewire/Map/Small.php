<?php

namespace App\Http\Livewire\Map;

use Livewire\Component;

class Small extends Component
{

    public $latitude;
    public $longitude;

    public function render()
    {
        return view('livewire.map.small');
    }
}
