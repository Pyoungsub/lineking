<?php

namespace App\Http\Livewire\Requested;

use Livewire\Component;

use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class Completed extends Component
{

    use WithPagination;

    public $days = ['일', '월','화', '수', '목', '금', '토'];

    public $showDetail;
    public $detailedInfo;
    public $showApplicants;

    public function render()
    {
        return view('livewire.requested.completed',[
            'results' => SubstituteRequest::where('user_id', Auth::user()->id)
                ->where('type', 'completed')
                ->orderBy('reservedDatetime')
                ->paginate(10),
        ]);
    }
}
