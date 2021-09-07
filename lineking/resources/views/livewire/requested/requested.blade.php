<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('줄서기 요청내역') }}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white mt-2 p-4 rounded-lg">
        @livewire('button', ['type'=>'requested'])
        @if($test)
            <div class="mt-1">
                요청한 라이너 리스트 보기
            </div>
            <div>
                라이너
                제시금액
                회원등급
                줄 서기 경력
            </div>
            <div>
                고길동
                25,000원
                베테랑
                102회
            </div>
        @else
        <div class="md:flex md:flex-row-reverse">
            <div class="w-full sm:w-1/3">
                <div class="mt-1 rounded-lg shadow-sm border-2 border-green-700">
                    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=070ab20adcdb9a7b504725820ffd152c"></script>
                    <div id="map" class="max-w-full h-48 rounded-t-lg rounded-b-lg md:rounded-b-none"></div>
                    <script>
                        var mapContainer = document.getElementById('map'),
                            mapOption = { 
                                center: new kakao.maps.LatLng({{$result->latitude}}, {{$result->longitude}}),
                                level: 3
                            };
                        var map = new kakao.maps.Map(mapContainer, mapOption);
                        var markerPosition  = new kakao.maps.LatLng({{$result->latitude}}, {{$result->longitude}}); 
                        var marker = new kakao.maps.Marker({
                            position: markerPosition
                        });
                        marker.setMap(map);
                    </script>
                    <div class="hidden p-2 rounded-b-lg md:block">
                        <div class="text-gray-500">지원한 요청자</div>
                        
                        @if(count($result->applicants)>0)
                        <div class="flex pt-1">
                            @foreach($result->applicants as $index => $applicant)
                            <div class="pr-3 flex">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{Illuminate\Support\Facades\Auth::user()->profile_photo_url}}" alt="{{ Illuminate\Support\Facades\Auth::user()->name }}">
                                <p class="p-1">{{App\Models\User::find($applicant->user_id)->name}}</p>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="mt-2 w-full py-2 text-center text-white bg-green-700 rounded" wire:click="reviewingApplicants({{$result->id}})">지원자 리스트</button>
                        @else
                            <div class="pr-1 font-bold text-green-700">
                                지원한 요청자가 없습니다.
                            </div>
                        @endif
                    </div>
                </div>            
            </div>
            <div class="w-full sm:w-2/3">
                <p>{{__('장소')}}</p>
                <h2 id="placeName">
                    @if($result->placeName)
                        {{$result->placeName}} {{$result->detailedAddress}}
                    @else
                        {{$result->addressName}} {{$result->detailedAddress}}
                    @endif
                </h2>
                <p>{{__('시간')}}</p>
                <h2>
                    {{date('Y.m.d',strtotime($result->reservedDatetime))}}
                    ({{$days[date('w',strtotime($result->reservedDatetime))]}})
                    @if(date('h',strtotime($result->reservedDatetime))>12)
                        {{__('오후')}}
                        {{date('h',strtotime($result->reservedDatetime))-12}}{{__(':')}}{{date('i',strtotime($result->reservedDatetime))}}
                    @else
                        {{__('오전')}}
                        {{date('h:i',strtotime($result->reservedDatetime))}}
                    @endif
                </h2>
                <p>추가사항</p>
                <div class="h-5">{{$result->detailedMessage}}</div>
                
            </div>
        </div>
        <div class="text-green-700 flex cursor-pointer" wire:click="backToList">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#047857" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg> 진행중 요청 목록
        </div>
        @endif
    </div>
</div>