<?php

namespace App\Http\Livewire\Apply;

use App\Models\User;
use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use Livewire\Component;

class Show extends Component
{
    use WithPagination;

    public $status='apply';

    public $showDetails;
    public $showApplicants;

    public $detailedInfo;
    public $offerInfo;

    public $selectedDeputy;

    
    public $doubleCheckModal;
    public $ratingModal;

    protected $listeners =['statusChanged'];

    public function statusChanged($status)
    {
        $this->status = $status;
        $this->resetPage();
    }

    public function apply()
    {
        $this->status = 'apply';
        $this->resetPage();
    }

    public function selected()
    {
        $this->status = 'selected';
        $this->resetPage();
    }

    public function completed()
    {
        $this->status = 'completed';
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.apply.show');
    }
}
