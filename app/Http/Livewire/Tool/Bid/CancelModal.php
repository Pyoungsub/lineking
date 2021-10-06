<?php

namespace App\Http\Livewire\Tool\Bid;

use Livewire\Component;

use App\Models\Deputy;

class CancelModal extends Component
{
    public $userId;
    public $requestedId;

    public $offerCancel;

    protected $listeners = ['cancelOfferModal'];

    public function cancelOfferModal()
    {
        $this->offerCancel = true;
    }

    public function cancelThisOffer()
    {
        Deputy::where(['user_id' => $this->userId, 'substitute_request_id' => $this->requestedId])->delete();
        return redirect()->route('main');
    }

    public function render()
    {
        return view('livewire.tool.bid.cancel-modal');
    }
}
