<div class="bg-gray-100">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div>
            줄 서기,<br>더 즐겁게 참여하는 방법!
        </div>
        <div class="flex justify-between mb-4">
            <div class="text-green-700 text-xl font-bold">헤드라인 알바</div>
            <div class="flex gap-1">
            <div class="relative">
                <div class="relative" x-data="{open: false}" @click.away="open = false" @close.stop="open = false">
                    <div @click = "open = ! open">
                        <button class="flex" type="button">
                                지역별<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                            </button>
                        </div>
                        <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-2 w-52 rounded-md shadow-lg orign-top-right right-0"
                                style="display: none;">
                            <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                <div class="grid grid-cols-4">
                                    <div class="border-r-2 border-gray-200">
                                    @foreach($statesList as $stateList)
                                        <div class="{{$state == $stateList->id ? 'text-green-700 font-bold':''}} cursor-pointer block p-1 text-center text-xs text-gray-400 hover:font-bold hover:text-green-700" wire:click="citiesList({{$stateList->id}})">
                                            {{$stateList->state_name}}
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="col-span-3" @click="open = false">
                                        <div class="flex flex-wrap text-xs text-gray-400">
                                            @foreach($citiesList as $city)
                                                @if ($loop->first)
                                                    <div class="p-1 cursor-pointer hover:font-bold hover:text-green-700" wire:click="sortByState({{$state}})">{{__('전체')}}</div>
                                                @endif
                                                <div class="p-1 cursor-pointer hover:font-bold hover:text-green-700" wire:click="sortByCity({{$state}},{{$city->id}})">{{$city->city_name}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="flex cursor-pointer" wire:click="newest()">
                최신순<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                </div>
            </div>
        </div>
        @if($totalRecords>0)
            <div class="m-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:m-0">
            @foreach($results as $result)
                <div class="transform hover:-translate-y-2 duration-200 rounded-lg ring-2 ring-gray-200 bg-logo-item bg-white" wire:click="details({{$result->id}})">
                    <div class="rounded-t-lg p-4">
                        <p class="font-bold">
                            @if($result->placeName)
                                {{$result->placeName}}<br>{{$result->detailedAddress}}
                            @else
                                {{$result->addressName}}<br>{{$result->detailedAddress}}
                            @endif
                        <p>
                            {{date('m.d',strtotime($result->reservedDatetime))}}
                            ({{$days[date('w',strtotime($result->reservedDatetime))]}})
                            {{substr($result->reservedDatetime,10,-3)}}입장
                        </p>
                    </div>
                    <div class="grid grid-cols-2 bg-green-700 rounded-b-lg p-4 text-white">
                        <div>
                            <p class="text-xs">현재</p>
                            <p class="text-xl">
                                @if($result->deputy)
                                    {{$result->deputy->amount}}<span class="text-sm">원</span>
                                @else
                                    {{number_format($result->maximumCost)}}<span class="text-sm">원</span>
                                @endif    
                            </p>
                        </div>
                        <div>
                            <p class="text-xs">최고</p>
                            <p class="text-xl">{{number_format($result->maximumCost)}}<span class="text-sm">원</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            
            @if($loadAmount >= $totalRecords)
                <p class="text-gray-500 font-bold text-center mt-10 my-10 text-xs">모든 자료를 확인 했습니다</p>
            @endif
        @else
            <div>
                자료 없음
            </div>
        @endif
        <script>
            window.onscroll = function(ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('loadMore');
                }
            };
        </script>
    </div>
</div>