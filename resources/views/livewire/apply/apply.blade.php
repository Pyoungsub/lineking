<div>
    @if($showDetail)
        <div>
            <div class="md:flex md:flex-row-reverse mt-10">
                <div class="md:w-1/3">
                    <div class="rounded-lg md:shadow-lg">
                        @livewire('map.small',['latitude' => $requestedInfo->latitude, 'longitude' => $requestedInfo->longitude])
                        <div class="hidden p-4 rounded-b-lg md:block">
                            @livewire('tool.bid.md', ['requestedId'=>$requestedInfo->id])
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
                진행중 요청 목록
            </div>
        </div>
    @else
        <div class="text-green-700 font-bold my-5">
            {{__('줄서기 지원내역')}}
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
                    <div class="flex w-full p-2 text-gray-600 text-sm hover:bg-gray-200 cursor-pointer" wire:click="details({{$result->findRequest->id}})">
                        <div class="w-1/2">
                            @if($result->findRequest->placeName)
                                {{$result->findRequest->placeName}} {{$result->findRequest->detailedAddress}}
                            @else
                                {{$result->findRequest->addressName}} {{$result->findRequest->detailedAddress}}
                            @endif
                        </div>
                        <div class="w-1/4">
                            {{number_format($result->amount)}}{{__('원')}}
                        </div>
                        <div class="w-1/4">
                            {{date('Y.m.d',strtotime($result->findRequest->reservedDatetime))}}
                            ({{$days[date('w',strtotime($result->findRequest->reservedDatetime))]}})
                            @if(date('h',strtotime($result->findRequest->reservedDatetime))>12)
                                {{__('오후')}}
                                {{date('h',strtotime($result->findRequest->reservedDatetime))-12}}{{__(':')}}{{date('i',strtotime($result->findRequest->reservedDatetime))}}
                            @else
                                {{__('오전')}}
                                {{date('h:i',strtotime($result->findRequest->reservedDatetime))}}
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="flex w-full p-2 text-gray-600 text-sm hover:bg-gray-200">
                    줄서기 지원내역이 없습니다
                </div>
            @endif
            {{ $results->links() }}
        </div>
    @endif
</div>