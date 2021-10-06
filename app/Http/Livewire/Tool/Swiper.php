<?php

namespace App\Http\Livewire\Tool;

use App\Models\Deputy;

use Livewire\Component;

class Swiper extends Component
{
    public $applicants;

    public function mount($id)
    {
        $this->applicants = Deputy::where('substitute_request_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.tool.swiper');
    }
}
