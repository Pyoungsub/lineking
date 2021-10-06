<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\SubstituteRequest;
use App\Models\Deputy;

class Details extends Component
{
    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $requestedId;
    public $result;

    public function test()
    {
        return redirect()->route('main');
    }

    public function mount($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->user_id)
        {
            //return redirect()->route('requested.details',['id'=>$id]);
            return redirect()->route('requested');
        }else{
            $this->requestedId = $id;
            $this->result = SubstituteRequest::find($id);
        }
    }

    public function render()
    {
        return view('livewire.main.details');
    }
}
