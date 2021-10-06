<div>
    @if($showDetail)
        <div>
            <div class="md:flex md:flex-row-reverse mt-10">
                <div class="md:w-1/3">
                    <div class="rounded-lg md:shadow-lg">
                        @livewire('map.small',['latitude' => $requestedInfo->latitude, 'longitude' => $requestedInfo->longitude])
                        <div class="hidden p-4 rounded-b-lg md:block"> 
                            <div class="text-gray-500 mb-2">
                                {{__('선택된 라이너')}}
                            </div>
                            <div class="flex mb-4">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{$requestedInfo->user->profile_photo_url}}" alt="{{$requestedInfo->user->name}}">    
                                <div class="ml-2">
                                    <div>
                                        {{$requestedInfo->user->name}}
                                    </div>
                                    <div class="text-green-500 text-sm flex" wire:click="chatStart({{$requestedInfo->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="arcs"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                        메세지 보내기
                                    </div>
                                </div>
                            </div>
                            @if($offeredInfo->status == 'ready')
                                <button class="w-full bg-green-700 text-white py-3 rounded">{{__('줄을 넘겼습니다')}}</button>    
                            @else
                                <button class="w-full bg-green-700 text-white py-3 rounded" wire:click="askToPassTheQueue({{$requestedInfo->id}})">{{__('줄 넘겨주기')}}</button>    
                            @endif
                            <x-jet-dialog-modal wire:model="doubleCheckModal">
                                <x-slot name="title">
                                    <span class="font-bold text-sm text-gray-600">{{ __('줄 넘겨주기') }}</span>
                                </x-slot>

                                <x-slot name="content">
                                    <span class="font-bold text-sm text-gray-600">{{__('요청자에게 줄을 넘겨 주시겠습니까?')}}</span>
                                </x-slot>

                                <x-slot name="footer">
                                    <div class="grid grid-cols-2 h-10 text-green-700">
                                        <button wire:click="$toggle('doubleCheckModal')" wire:loading.attr="disabled" class="font-bold border-r-2 border-gray-400">{{_('아니오')}}</button>
                                        <button wire:click="passTheQueue({{$requestedInfo->id}})"
                                                wire:loading.attr="disabled" class="font-bold">{{_('예')}}</button>
                                    </div>
                                </x-slot>
                            </x-jet-dialog-modal>
                        </div>
                    </div>
                </div>
                <div class="md:w-2/3">
                    <div class="text-sm text-gray-600">장소</div>
                    <div class=" text-xl">
                        @if($requestedInfo->placeName)
                            {{$requestedInfo->placeName}} {{$requestedInfo->detailedAddress}}
                        @else
                            {{$requestedInfo->addressName}} {{$requestedInfo->detailedAddress}}
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 mt-10">시간</div>
                    <div>
                        {{date('Y.m.d',strtotime($requestedInfo->reservedDatetime))}}
                        ({{$days[date('w',strtotime($requestedInfo->reservedDatetime))]}})
                        @if(date('h',strtotime($requestedInfo->reservedDatetime))>12)
                            {{__('오후')}}
                            {{date('h',strtotime($requestedInfo->reservedDatetime))-12}}{{__(':')}}{{date('i',strtotime($requestedInfo->reservedDatetime))}}
                        @else
                            {{__('오전')}}
                            {{date('h:i',strtotime($requestedInfo->reservedDatetime))}}
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 mt-10">추가사항</div>
                    <div class="text-sm text-gray-700">
                        @if($requestedInfo->detailedMessage)
                            {{$requestedInfo->detailedMessage}}
                        @else
                            {{__('추가사항이 없습니다')}}
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-sm text-cancel flex cursor-pointer" wire:click="backToTheList">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#40ACFC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="arcs"><path d="M15 18l-6-6 6-6"/></svg>
                진행중 알바 목록
            </div>
        </div>
    @else
        <div class="text-green-700 font-bold my-5">
            {{__('진행중인 알바내역 보기')}}
        </div>
        <div class="flex w-full p-2">
            <div class="w-1/2">{{__('줄서기장소')}}</div>
            <div class="w-1/4">{{__('입찰금액')}}</div>
            <div class="w-1/4">{{__('입장시간')}}</div>
        </div>
        <div class="py-2">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="sm:h-96">
            @if(count($results)>0)
                @foreach($results as $result)
                    <div class="flex w-full p-2 text-gray-600 text-sm hover:bg-gray-200 cursor-pointer" wire:click="details({{$result->id}})">
                        <div class="w-1/2">
                            @if($result->placeName)
                                {{$result->placeName}} {{$result->detailedAddress}}
                            @else
                                {{$result->addressName}} {{$result->detailedAddress}}
                            @endif
                        </div>
                        <div class="w-1/4">
                            {{number_format($result->cost)}}{{__('원')}}
                        </div>
                        <div class="w-1/4">
                            {{date('Y.m.d',strtotime($result->reservedDatetime))}}
                            ({{$days[date('w',strtotime($result->reservedDatetime))]}})
                            @if(date('h',strtotime($result->reservedDatetime))>12)
                                {{__('오후')}}
                                {{date('h',strtotime($result->reservedDatetime))-12}}{{__(':')}}{{date('i',strtotime($result->reservedDatetime))}}
                            @else
                                {{__('오전')}}
                                {{date('h:i',strtotime($result->reservedDatetime))}}
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex w-full p-2 text-gray-600 text-sm hover:bg-gray-200">
                    진행중인 요청 내역이 없습니다
                </div>
            @endif
        </div>
    @endif
    {{ $results->links() }}
</div>