<?php

namespace App\Http\Livewire\Tool\Messages;

use Illuminate\Support\Facades\Auth;
use App\Models\SubstituteRequest;
use Illuminate\Database\Eloquent\Builder;

use Livewire\Component;

class Rooms extends Component
{
    public function chat($id)
    {
        return redirect()->route('message',['id'=>$id]);
    }

    protected function getListeners()
    {
        return [
            'refreshRooms' => '$refresh',
        ];
    }

    public function render()
    {
        return view('livewire.tool.messages.rooms',[
            'results' => SubstituteRequest::where('user_id', Auth::user()->id)
            ->where('type', 'reserved')
            ->whereDate('reservedDatetime', '>', now())
            ->orWhere('deputy_id', Auth::user()->id)
            ->where('type', 'reserved')
            ->whereDate('reservedDatetime', '>', now())
            ->orderBy('reservedDatetime')
            ->get()
        ]);
    }
}