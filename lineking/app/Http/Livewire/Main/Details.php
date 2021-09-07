<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\SubstituteRequest;
use App\Models\Deputy;

class Details extends Component
{
    public $minimumCost;
    public $maximumCost;

    public function mount($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->user_id)
        {
            return redirect()->route('requested.details',['id'=>$id]);
        }else{
            $this->maximumCost = SubstituteRequest::find($id);
        }
    }

    public function render()
    {
        return view('livewire.main.details');
    }
}
