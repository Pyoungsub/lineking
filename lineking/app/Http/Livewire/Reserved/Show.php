<?php

namespace App\Http\Livewire\Reserved;

use Livewire\Component;

use App\Models\SubstituteRequest;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $type='reserved';

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $totalRecords;
    public $loadAmount = 20;

    public function loadMore()
    {
        $this->loadAmount += 10;
    }

    public function mount()
    {
        $this->totalRecords = SubstituteRequest::where('user_id', Auth::user()->id)->where('type', 'reserved')->whereDate('reservedDatetime', '>=',now())->count();
    }

    public function render()
    {
        return view('livewire.reserved.show')
            ->with(
                'results', SubstituteRequest::where('user_id', Auth::user()->id)->where('type', 'reserved')->whereDate('reservedDatetime', '>=',now())->limit($this->loadAmount)->get()
            );
    }
}
