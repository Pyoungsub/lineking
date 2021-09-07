<?php

namespace App\Http\Livewire\Login;

use Livewire\Component;

use App\Models\State;
use App\Models\City;

class Location extends Component
{

    public $states;
    public $cities;
    public $test;

    public $selectedState = null;
    public $selectedCity = null;

    public function mount()
    {
        $this->states = State::orderBy('id')->get();
        $this->cities = collect();
    }

    public function render()
    {
        return view('livewire.login.location');
    }

    public function updatedSelectedState($state)
    {
        if($state<>null){
            $this->cities = City::where('state_id', $state)->orderBy('id')->get();
        }else{
            $this->selectedState = null;
        }
    }
}
