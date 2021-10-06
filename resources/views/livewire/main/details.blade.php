<div class="max-w-6xl mx-auto md:px-6 lg:px-8">
    <div class="md:pt-28">
        <div class="md:flex md:flex-row-reverse">
            <div class="w-full md:w-1/3">
                <div class="mt-1 rounded-lg shadow-md">
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
                    <div class="hidden bg-white p-2 rounded-b-lg md:block">
                        @livewire('tool.bid.md', ['requestedId'=>$requestedId])
                    </div>
                </div>            
            </div>
            <div class="p-2 w-full md:w-2/3">
                <p class="font-bold text-green-700">줄서기 알바하기</p>
                <p class="font-bold text-gray-500">{{__('장소')}}</p>
                <h2 id="placeName">
                    @if($result->placeName)
                        {{$result->placeName}} {{$result->detailedAddress}}
                    @else
                        {{$result->addressName}} {{$result->detailedAddress}}
                    @endif
                </h2>
                <p class="font-bold text-gray-500">{{__('시간')}}</p>
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
                <p class="font-bold text-gray-500">추가사항</p>
                <div>{{$result->detailedMessage}}</div>
            </div>
            <div class="p-2 rounded-b-lg md:hidden">
                @livewire('tool.bid.all', ['requestedId'=>$requestedId])
            </div>
        </div>
        <div wire:click="test" class="flex text-cancel"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#7FC7FD" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>줄서기 지원 목록</div>
    </div>
</div>
