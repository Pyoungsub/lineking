<?php

namespace App\Http\Livewire\Payment;

use App\Models\SubstituteRequest;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Show extends Component
{
    public $startDate;
    public $endDate;

    public $results;

    protected $rules = [
        'startDate' => 'required',
        'endDate' => 'required',
    ];

    protected $messages = [
        'startDate.required' => '조회 시작일자를 입력해 주세요',
        'endDate.required' => '조회 종료일자를 입력해 주세요',
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function search()
    {
        $validatedData = $this->validate();
        $this->results = SubstituteRequest::where('user_id', Auth::user()->id)
            ->whereDate('reservedDatetime', '>=', $this->startDate)
            ->whereDate('reservedDatetime', '<=', $this->endDate)
            ->whereIn('type', ['canceled', 'completed'])
            ->orderBy('created_at')
            ->get();
        
    }

    public function render()
    {
        return view('livewire.payment.show');
    }
}
