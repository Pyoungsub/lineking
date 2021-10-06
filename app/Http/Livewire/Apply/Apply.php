<?php

namespace App\Http\Livewire\Apply;

use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

use Livewire\Component;

class Apply extends Component
{
    use WithPagination;

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $showDetail;
    public $requestedInfo;

    public function details($id)
    {
        $this->showDetail = true;
        $this->requestedInfo = SubstituteRequest::find($id);
    }

    public function backToTheList()
    {
        $this->requestedInfo = false;
        $this->showDetail = false;
    }



    public function render()
    {
        return view('livewire.apply.apply',[
            'results' => Deputy::where('user_id', Auth::user()->id)
            ->where('status', 'apply')
            ->whereDate('reservedDatetime', '>', now())
            ->orWhere(function($query){
                $query->whereDate('reservedDatetime', '=', now())
                    ->whereTime('reservedDatetime', '>', now());
            })
            ->orderBy('reservedDatetime')
            ->paginate(10),
        ]);
    }
}
