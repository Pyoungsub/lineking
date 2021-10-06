<?php

namespace App\Http\Livewire\Request;

use Livewire\Component;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Auth;
use App\Models\SubstituteRequest;
use App\Models\State;
use App\Models\City;

class Form extends Component
{
    public $maximumCost;
    public $state;
    public $city;
    public $addressName;
    public $x;
    public $y;
    public $reservedDate;
    public $reservedTime;
    public $reservedDatetime;
    public $placeName;
    public $detailedAddress;
    public $detailedMessage;

    public $fullAddress;
    
    public $totalPage;
    public $trigger;
    public $timeList;

    public $addressExistCheck;
    public $locations=[];
    public $pageNumber=1;

    public function updatedFullAddress()
    {
        $this->addressExistCheck = false;
        if($this->fullAddress!="")
        {
            $results= Http::withHeaders([
                'Authorization' => 'KakaoAK 6eb00195fa2ed709cb739a4926dc6d58',
            ])->get('https://dapi.kakao.com/v2/local/search/keyword.json',[
                'query' => $this->fullAddress,
                'page' => $this->pageNumber,
                'size' => 10,
            ]);
            if($results->status()==200){
                $this->locations =  json_decode($results->body(), true);
                //페이지 수
                if($this->locations['meta']['is_end']<>true)
                {

                }
                if($this->locations['meta']['total_count']>0)
                {
                    $this->trigger=true;                
                }
            }
        }else{
            $this->trigger=false;
            $this->addressExistCheck = true;
        }
    }

    public function getAddressInfo($name,$placeName,$x,$y)
    {
        $this->resetErrorBag();
        if($placeName){
            $this->fullAddress = $name.'('.$placeName.')';
        }else{
            $this->fullAddress = $name;
        }
        $this->addressName = $name;
        $this->placeName = $placeName;
        $this->x = $x;
        $this->y = $y;
        $this->trigger = false;
        $this->addressExistCheck = true;
    }

    public function getAMap($value1,$value2)
    {
        $this->emit('getLatLon', $value1, $value2);
    }

    public function inputTime($value)
    {
        $this->reservedTime=$value;
    }

    public function render()
    {
        return view('livewire.request.form');
    }

    protected $rules = [
        'fullAddress' => ['required', 'string', 'max:255'],
        'detailedAddress' => ['nullable', 'string', 'max:255'],
        'reservedDate' => ['required', 'date', 'after_or_equal:today'],
        'reservedTime' => ['required', 'date_format:H:i'],
        'maximumCost' => ['required', 'numeric'],
        'detailedMessage' => ['nullable','string', 'max:255'],
    ];

    protected $messages = [
        'fullAddress.required' => '주소를 입력해 주세요.',
        'fullAddress.string' => '주소의 형식이 올바르지 않습니다.',
        'fullAddress.max' => '입력된 주소의 길이가 올바르지 않습니다.',

        'detailedAddress.string' => '세부장소의 형식이 올바르지 않습니다.',
        'detailedAddress.max' => '세부장소의 길이가 올바르지 않습니다.',

        'reservedDate.required' => '예약날짜를 입력해 주세요.',
        'reservedDate.date' => '예약날짜의 형식이 올바르지 않습니다.',
        'reservedDate.after_or_equal' => '예약날짜의 형식이 올바르지 않습니다.',

        'reservedTime.required' => '예약시간을 입력해 주세요.',
        'reservedTime.date_format' => '예약시간의 형식이 올바르지 않습니다.',

        'maximumCost.required' => '최대금액을 입력해 주세요.',
        'maximumCost.numeric' => '최대금액은 숫자만 입력해 주세요.',

        'detailedMessage.string' => '추가사항의 형식이 올바르지 않습니다.',
        'detailedMessage.max' => '추가사항의 길이가 올바르지 않습니다.',
    ];

    public function requestingSubstitute()
    {
        if($this->addressExistCheck){      
            $validatedData = $this->validate();
            $state_name = explode(" ",$this->fullAddress)[0];

            $city_first_value = explode(" ",$this->fullAddress)[1];
            $city_second_value = explode(" ",$this->fullAddress)[1]." ".explode(" ",$this->fullAddress)[2];

            $this->state = State::where('state_name',$state_name)->firstOrCreate();

            if(City::where(['state_id'=> $this->state->id,'city_name' => $city_first_value])->count()==1){
                $this->city = City::where(['state_id'=> $this->state->id,'city_name' => $city_first_value])->firstOrCreate();
            }else{
                $this->city = City::where(['state_id'=> $this->state->id,'city_name' => $city_second_value])->firstOrFail();
            }

            $this->reservedDatetime = $this->reservedDate.' '.$this->reservedTime.':00';

            $newRequest = SubstituteRequest::where([
                ['user_id', '=',Auth::user()->id],
                ['maximumCost', '=',$this->maximumCost],
                ['state_id', '=',$this->state->id],
                ['city_id', '=',$this->city->id],
                ['addressName', '=',$this->addressName],
                ['longitude', '=',$this->x],
                ['latitude', '=',$this->y],
                ['reservedDatetime', '=',$this->reservedDatetime],
                ['placeName', '=',$this->placeName],
                ['detailedAddress', '=',$this->detailedAddress],
                ['detailedMessage', '=',$this->detailedMessage],
                ['type','=','requested'],
            ])->first();
            
            if($newRequest){
                return redirect('/requested');    //이미 있는 자료임
            }else{
                SubstituteRequest::create([
                    'user_id' => Auth::user()->id,
                    'maximumCost' => $this->maximumCost,
                    'state_id' => $this->state->id,
                    'city_id' => $this->city->id,
                    'addressName' => $this->addressName,
                    'longitude' => $this->x,
                    'latitude' => $this->y,
                    'reservedDatetime' => $this->reservedDatetime,
                    'placeName' => $this->placeName,
                    'detailedAddress' => $this->detailedAddress,
                    'detailedMessage' => $this->detailedMessage,
                    'type' => 'requested',
                ]);
                return redirect('/requested');
            }
        }else{
            $validator = Validator::make([], []);
            $validator->errors()->add('fullAddress', '주소를 검색후 선택해 주세요.');
            throw new ValidationException($validator);
        }
    }
}
