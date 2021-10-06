<?php

namespace App\Http\Livewire\Requested;

use Livewire\Component;

use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class Reserved extends Component
{
    use WithPagination;

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $showDetail;
    public $detailedInfo;

    public $cancelPaymentModal;
    public $doubleCheckModal;

    public function details($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->user_id)
        {
            $this->showDetail = true;
            $this->detailedInfo = SubstituteRequest::find($id);
        }
    }

    public function chatStart($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->user_id)
        {
            dd($id);
        }
    }

    public function askCancelPayment()
    {
        $this->cancelPaymentModal = true;
    }

    public function cancelPayment($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->user_id)
        {
            $this->detailedInfo->update(['type' => 'canceled']);
            $this->detailedInfo->applicants()->update(['status' => 'canceled']);

            $this->showDetail = false;

            $this->cancelPaymentModal = false;
            $this->detailedInfo = false;
        }
    }

    public function askToBeReceivedTheQueue()
    {
        if(Auth::user()->id == $this->detailedInfo->user_id)
        {
            if(Deputy::where(['substitute_request_id' => $this->detailedInfo->id, 'status' => 'ready'])->first())
            {
                $this->doubleCheckModal = true;
            }
        }
    }

    public function receivedQueue($id)
    {
        if(Auth::user()->id == $this->detailedInfo->user_id)
        {
            if(Deputy::where(['substitute_request_id' => $this->detailedInfo->id, 'status' => 'ready'])->first())
            {
                SubstituteRequest::find($this->detailedInfo->id)
                ->update([
                    'type' => 'completed',
                ]);
                Deputy::where(['substitute_request_id' => $this->detailedInfo->id, 'status' => 'ready'])
                ->update([
                    'status' => 'completed',
                ]);
                Deputy::where(['substitute_request_id' => $this->detailedInfo->id, 'status' => 'apply'])
                ->delete();
                
                $this->doubleCheckModal = false;

                $this->showDetail = false;
                $this->showApplicants = false;
                $this->selectedDeputy = false;

                $this->emit('typeChanged', 'completed');
            }
        }
    }

    public function render()
    {
        return view('livewire.requested.reserved',[
            'results' => SubstituteRequest::where('user_id', Auth::user()->id)
                ->where('type', 'reserved')
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
