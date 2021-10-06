<?php

namespace App\Http\Livewire\Requested;

use Livewire\Component;

use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class Requested extends Component
{
    use WithPagination;

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $showDetail;
    public $detailedInfo;
    public $showApplicants;
    public $selectedDeputy;

    public function details($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->user_id)
        {
            $this->showDetail = true;
            $this->detailedInfo = SubstituteRequest::find($id);
        }
    }

    public function checkApplicants()
    {
        $this->showDetail = false;
        $this->showApplicants = true;
    }

    public function chooseApplicant($id)
    {
        if(Auth::user()->id == Deputy::find($id)->findRequest->user_id)
        {
            $this->selectedDeputy = Deputy::find($id);       
            $this->showDetail = true;
            $this->showApplicants = false;
        }
    }

    public function backToTheList()
    {
        $this->detailedInfo = false;
        $this->showDetail = false;
        $this->showApplicants = false;
        $this->selectedDeputy = false;
    }

    public function payment($value1, $value2)
    {
        //$id is the id of substitute_requests
        //payment has to be tried
        //if payment has been completed
        if(Auth::user()->id == SubstituteRequest::find($value1)->user_id)
        {
            SubstituteRequest::where('id' , $value1)->update([
                'deputy_id' => $this->selectedDeputy->user_id,
                'cost' => $this->selectedDeputy->amount,
                'type' => 'reserved',
            ]);
            Deputy::where(['user_id' => $this->selectedDeputy->user_id, 'substitute_request_id' => $value1])->update([
                'status' => 'selected',
            ]);
            $this->selectedDeputy = false;
            $this->emit('typeChanged', 'reserved');
        }
    }

    public function render()
    {
        return view('livewire.requested.requested',[
            'results' => SubstituteRequest::where('user_id', Auth::user()->id)
                ->where('type', 'requested')
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
