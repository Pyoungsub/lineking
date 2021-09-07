<?php

namespace App\Http\Livewire\Request;

use Livewire\Component;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class Map extends Component
{
    public $x;
    public $y;
    public $location;

    protected $listeners = ['getLatLon'];

    public function getLatLon($value1,$value2)
    {
        $this->dispatchBrowserEvent('displayPlace', ['x'=>$value1,'y'=>$value2]);
    }

    public function mount()
    {
        $this->x = 37.566826;
        $this->y = 126.9786567;
    }
    public function render()
    {
        return view('livewire.request.map');
    }
}