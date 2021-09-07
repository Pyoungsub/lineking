<?php

namespace App\Http\Livewire\Requested;

use Livewire\Component;

use App\Models\SubstituteRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class Requested extends Component
{
    public $type = 'requested';
    public $result;

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $test;

    public function backToList()
    {
        return redirect()->route('requested');
    }

    public function reviewingApplicants($id)
    {
        $this->test = true;
    }

    public function mount($id)
    {
        $this->result = SubstituteRequest::where('user_id', Auth::user()->id)->where(['type'=> $this->type, 'id'=>$id])->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
            $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
        })->firstOrFail();
    }

    public function render()
    {
        return view('livewire.requested.requested');
    }
}
