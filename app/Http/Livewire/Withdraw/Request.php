<?php

namespace App\Http\Livewire\Withdraw;

use Illuminate\Support\Facades\Auth;
use App\Models\SubstituteRequest;
use App\Models\Bank;
use App\Models\Withdraw;

use Livewire\Component;

class Request extends Component
{
    public $number_of_experiences;
    public $banks;
    public $balance;

    public $withdrawal;
    public $afterFees;
    public $bank_id;
    public $accountHolder;
    public $bankAccount;

    protected function rules()
    {
        return [
            'withdrawal' => ['required', 'numeric', 'lte:'.$this->balance],
            'bank_id' => 'required|numeric',
            'accountHolder' => 'required|string|regex:/^[\pL\pM]+$/u',
            'bankAccount' => 'required|numeric|digits_between:11,14',
        ];
    }

    protected $messages = [
        'withdrawal.required' => '인출할 금액을 입력해주세요',
        'withdrawal.numeric' => '숫자만 입력해 주세요',
        'withdrawal.lte' => '출금요청금액은 현재보유금액보다 작거나 같아야 합니다',

        'bank_id.required' => '은행을 선택해 주세요',
        'bank_id.numeric' => '은행선택을 올바르게 해 주세요',

        'accountHolder.required' => '예금주 이름을 입력해 주세요',
        'accountHolder.string' => '예금주 이름이 올바르지 않습니다',
        'accountHolder.regex' => '한글과 영어만 지원됩니다',

        'bankAccount.required' => '계좌번호를 입력해 주세요',
        'bankAccount.numeric' => '숫자만 입력해 주세요',
        'bankAccount.digits_between' => '계좌번호를 올바르게 입력해 주세요',
    ];
 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedWithdrawal($id)
    {
        if((int)$id>0 && $this->balance >= $id){
            if($this->number_of_experiences>=100)
            {
                $this->afterFees = $id*0.92;
            }else{
                $this->afterFees = $id*0.9;
            }
        }else{
            $this->afterFees = null;
        }
    }

    public function withdrawRequest()
    {
        $validatedData = $this->validate();
        Withdraw::create([
            'user_id' => Auth::user()->id,
            'withdraw_amount' => $this->withdrawal,
            'afterFees' => $this->afterFees,
            'bank_id' => $this->bank_id,
            'accountHolder' => $this->accountHolder,
            'bankAccount' => $this->bankAccount,
        ]);

        $this->balance = SubstituteRequest::where(['deputy_id' => Auth::user()->id, 'type' => 'completed'])->sum('cost') - Auth::user()->withdraw->sum('withdraw_amount');
        $this->number_of_experiences = SubstituteRequest::where(['deputy_id' => Auth::user()->id, 'type' => 'completed'])->count();

        $this->reset(['withdrawal', 'afterFees', 'bank_id', 'accountHolder', 'bankAccount']);

        $this->emit('withdraw', 'history');
    }

    public function mount()
    {
        $this->banks = Bank::All();
        $this->balance = SubstituteRequest::where(['deputy_id' => Auth::user()->id, 'type' => 'completed'])->sum('cost') - Auth::user()->withdraw->sum('withdraw_amount');
        $this->number_of_experiences = SubstituteRequest::where(['deputy_id' => Auth::user()->id, 'type' => 'completed'])->count();
    }

    public function render()
    {
        return view('livewire.withdraw.request');
    }
}
