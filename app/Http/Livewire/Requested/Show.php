<?php

namespace App\Http\Livewire\Requested;

use App\Models\User;
use App\Models\SubstituteRequest;
use App\Models\Deputy;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

use Livewire\Component;

class Show extends Component
{
    use WithPagination;
    
    public $type='requested';

    public $showDetails;
    public $showApplicants;

    public $detailedInfo;
    public $offerInfo;

    public $selectedDeputy;

    
    public $doubleCheckModal;
    public $ratingModal;

    protected $listeners =['typeChanged'];

    public function typeChanged($type)
    {
        $this->type = $type;
        $this->resetPage();
    }

    public function requested()
    {
        $this->type = 'requested';
        $this->resetPage();
    }

    public function reserved()
    {
        $this->type = 'reserved';
        $this->resetPage();
    }

    public function completed()
    {
        $this->type = 'completed';
        $this->resetPage();
    }

    public function render()
    {        
        return view('livewire.requested.show');
    }
}