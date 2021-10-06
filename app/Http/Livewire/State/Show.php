<?php

namespace App\Http\Livewire\State;

use Livewire\Component;

class Show extends Component
{
    public $test;

    public function mount($state)
    {
        $this->test = $state;
    }

    public function render()
    {
        return view('livewire.state.show');
    }
}
