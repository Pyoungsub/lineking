<?php

namespace App\Http\Livewire\Withdraw;

use Livewire\Component;

class Show extends Component
{

    public $type;

    protected $listeners = ['withdraw'];

    public function withdraw($type)
    {
        $this->type = $type;
    }

    public function typeChange($type)
    {
        $this->type = $type;
    }

    public function mount()
    {
        $this->type = 'request';
    }

    public function render()
    {
        return view('livewire.withdraw.show');
    }
}
