<?php

namespace App\Http\Livewire\Withdraw;

use Illuminate\Support\Facades\Auth;
use App\Models\Withdraw;

use Livewire\Component;

class History extends Component
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
        $this->results = Withdraw::where('user_id', Auth::user()->id)
        ->whereDate('created_at', '>=', $this->startDate)
        ->whereDate('created_at', '<=', $this->endDate)
        ->orderBy('created_at')
        ->get();
    }

    public function render()
    {
        return view('livewire.withdraw.history');
    }
}
