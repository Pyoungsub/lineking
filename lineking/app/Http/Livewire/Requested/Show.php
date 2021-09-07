<?php

namespace App\Http\Livewire\Requested;

use Livewire\Component;

use App\Models\SubstituteRequest;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $type='requested';

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $totalRecords;
    public $loadAmount = 20;

    public function loadMore()
    {
        $this->loadAmount += 20;
    }

    public function details($value)
    {
        return redirect('/requested/'.$value);
    }

    public function mount()
    {
        $this->totalRecords = SubstituteRequest::where('user_id', Auth::user()->id)->where('type', 'requested')->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
            $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
        })->orderBy('reservedDatetime', 'asc')->count();
    }

    public function render()
    {
        return view('livewire.requested.show')
            ->with(
                'results', SubstituteRequest::where('user_id', Auth::user()->id)->where('type', 'requested')->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
                    $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
                })->orderBy('reservedDatetime', 'asc')->limit($this->loadAmount)->get()
            );
    }
}