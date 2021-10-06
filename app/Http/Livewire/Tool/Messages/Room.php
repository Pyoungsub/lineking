<?php

namespace App\Http\Livewire\Tool\Messages;

use App\Events\NewMessage;

use App\Models\SubstituteRequest;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Room extends Component
{
    public $message;
    public $reservation;
    public $reservationNumber;

    protected function getListeners()
    {
        return [
            "echo-private:chat.{$this->reservationNumber},NewMessage" => 'messageUpdated',
        ];
    }

    public function messageUpdated()
    {
        $this->reservation = SubstituteRequest::find($this->reservationNumber);
        $this->dispatchBrowserEvent('modifyScrollPosition');
    }

    public function sendMessage()
    {
        $conversation = Conversation::create([
            'substitute_request_id' => $this->reservationNumber,
            'user_id' => Auth::user()->id,
            'message' => $this->message
        ]);

        event(new NewMessage($conversation));
        $this->message=null;
    }

    public function mount($id)
    {
        if(SubstituteRequest::find($id)->type=="reserved")
        {
            if((int)SubstituteRequest::find($id)->user_id === (int)Auth::user()->id || (int)SubstituteRequest::find($id)->deputy_id === (int)Auth::user()->id)
            {
                $this->reservationNumber = $id;
                $this->reservation = SubstituteRequest::find($id);
            }else{
                return redirect()->route('messages');
            }
        }else{
            return redirect()->route('messages');
        }
    }

    public function render()
    {
        return view('livewire.tool.messages.room');
    }
}
