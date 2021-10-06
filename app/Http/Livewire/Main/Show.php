<?php

namespace App\Http\Livewire\Main;

use Livewire\Component;
use App\Models\State;
use App\Models\City;
use App\Models\SubstituteRequest;

class Show extends Component
{
    public $days = ['일', '월','화', '수', '목', '금', '토'];
    public $totalRecords;
    public $loadAmount = 20;

    public $state;
    public $city;

    public $state_id;
    public $city_id;

    public $statesList;
    public $citiesList;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $this->loadAmount += 20;
    }

    public function citiesList($state)
    {
        $this->state = $state;
        $this->citiesList = City::where('state_id', $state)->orderBy('id')->get();
    }

    public function newest()
    {
        $this->state = 1;
        $this->loadAmount = 20;
        $this->state_id = false;
        $this->city_id = false;
        $this->totalRecords = SubstituteRequest::where('type', 'requested')->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
            $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
        })->orderBy('created_at', 'desc')->count();
    }

    public function sortByState($state)
    {
        $this->loadAmount = 20;
        $this->state_id = $state;
        $this->city_id = false;
        $this->totalRecords = SubstituteRequest::where('type', 'requested')->where('state_id', $state)->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
            $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
        })->orderBy('reservedDatetime', 'asc')->count();
        $this->test = SubstituteRequest::where('type', 'requested')->where('state_id', $this->state)->orderBy('reservedDatetime', 'asc')->get();
    }

    public function sortByCity( $state, $city)
    {
        $this->loadAmount = 20;
        $this->state = $state;
        $this->state_id = $state;
        $this->city_id = $city;
        $this->totalRecords = SubstituteRequest::where('type', 'requested')->where('state_id', $this->state_id)->where('city_id', $this->city_id)->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
            $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
        })->orderBy('reservedDatetime', 'asc')->count();
    }

    public function details($id)
    {
        return redirect()->route('details',['id'=>$id]);
    }

    public function mount()
    {
        $this->state = 1;
        $this->statesList = State::orderBy('id')->get();
        $this->citiesList = City::where('state_id',$this->state)->orderBy('id')->get();
        $this->totalRecords = SubstituteRequest::where('type', 'requested')->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
            $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
        })->orderBy('reservedDatetime', 'asc')->count();
    }

    public function render()
    {
        if($this->state_id){
            if($this->city_id){
                //dd($this->state_id."/".$this->city_id."/".$this->loadAmount);
                return view('livewire.main.show')->with(
                    'results', SubstituteRequest::where(['type' => 'requested', 'state_id' => $this->state_id, 'city_id' => $this->city_id])->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
                        $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
                    })->orderBy('reservedDatetime', 'asc')->limit($this->loadAmount)->get()
                );
            }else{
                return view('livewire.main.show')->with(
                    'results', SubstituteRequest::where('type', 'requested')->where('state_id', $this->state_id)->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
                        $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
                    })->orderBy('reservedDatetime', 'asc')->limit($this->loadAmount)->get()
                );    
            }
        }else{
            return view('livewire.main.show')->with(
                'results', SubstituteRequest::where('type', 'requested')->whereDate('reservedDatetime', '>',now())->orWhere(function($query){
                    $query->whereDate('reservedDatetime', '=',now())->whereTime('reservedDatetime','>',now());
                })->orderBy('reservedDatetime', 'asc')->limit($this->loadAmount)->get()
            );
        }
    }
}
