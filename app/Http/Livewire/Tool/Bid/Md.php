<?php

namespace App\Http\Livewire\Tool\Bid;

use App\Models\SubstituteRequest;
use App\Models\Deputy;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class Md extends Component
{
    public $userId;
    public $requestedId;
    public $result;

    public $maximumCost;
    public $offeredAmount;
    public $buttonContent;

    public $offerAmount;

    public $showInput;

    protected $rules = [
        'offerAmount'=>'required|lte:maximumCost'
    ];

    protected $messages = [
        'offerAmount.required'=>'제시금액을 입력해 주시기 바랍니다.',
        'offerAmount.lte'=>'제시금액은 최대 예산보다 작거나 같아야 합니다.',
    ];

    public function submit()
    {
        $this->resetErrorBag();
        if($this->showInput == true){
            $this->validate();
            Deputy::updateOrInsert(
                ['substitute_request_id' => $this->requestedId, 'user_id' => Auth::user()->id, 'reservedDatetime' => $this->result->reservedDatetime,],
                ['amount' => $this->offerAmount]
            );
            $this->offeredAmount = Deputy::where(['substitute_request_id'=>$this->requestedId, 'user_id' => Auth::user()->id, 'reservedDatetime' => $this->result->reservedDatetime])->first();
            $this->offerAmount = null;
            $this->showInput = false;
            $this->buttonContent = "재입찰하기";
        }else{
            $this->showInput = true;
            $this->buttonContent = "금액제시";
        }
        
    }

    public function mount()
    {
        $this->offeredAmount = Deputy::where(['substitute_request_id'=>$this->requestedId, 'user_id' => Auth::user()->id])->first();
        if($this->offeredAmount){
            $this->showInput = false;
            $this->buttonContent = "재입찰하기";
        }else{
            $this->showInput = true;
            $this->buttonContent = "금액제시";
        }
        $this->userId = Auth::user()->id;
    }

    public function render()
    {
        $this->result = SubstituteRequest::find($this->requestedId);
        $this->maximumCost = SubstituteRequest::find($this->requestedId)->maximumCost;
        return view('livewire.tool.bid.md', [
            'maximumCost'=>$this->maximumCost,
            'result'=>$this->result,
        ]);
    }
}
