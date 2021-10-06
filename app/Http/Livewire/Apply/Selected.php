<?php

namespace App\Http\Livewire\Apply;

use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

use Livewire\Component;

class Selected extends Component
{

    use WithPagination;

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $showDetail;
    public $requestedInfo;
    public $offeredInfo;
    public $doubleCheckModal;

    public function details($id)
    {
        if(Auth::user()->id == SubstituteRequest::find($id)->deputy_id)
        {
            $this->showDetail = true;
            $this->requestedInfo = SubstituteRequest::find($id);
            $this->offeredInfo = Deputy::where(['user_id'=>Auth::user()->id, 'substitute_request_id'=>$id])->firstOrFail();
        }
    }

    public function backToTheList()
    {
        $this->showDetail = false;
        $this->requestedInfo = false;
    }

    public function askToPassTheQueue($id)
    {
        if(Auth::user()->id == $this->requestedInfo->deputy_id)
        {
            if(SubstituteRequest::where(['id' => $id, 'deputy_id' => $this->requestedInfo->deputy_id, 'type' => 'reserved'])->first() && Deputy::where(['substitute_request_id' => $id, 'status' => 'selected'])->first())
            {
                $this->doubleCheckModal = true;
            }
        }
    }

    public function passTheQueue($id)
    {
        if(Auth::user()->id == $this->requestedInfo->deputy_id)
        {
            if(Deputy::where(['substitute_request_id' => $id, 'status' => 'selected'])->firstOrFail())
            {
                Deputy::where(['substitute_request_id' => $this->requestedInfo->id, 'status' => 'selected'])
                ->update([
                    'status' => 'ready',
                ]);
                
                $this->showDetail = false;
                $this->requestedInfo = false;
                $this->doubleCheckModal = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.apply.selected',[
            'results' => SubstituteRequest::where('deputy_id', Auth::user()->id)
                ->where('type', 'reserved')
                ->orderBy('reservedDatetime')
                ->paginate(10),
        ]);
    }
}
