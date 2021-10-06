<div>
    @if($showDetail)
        <div>
            <div class="md:flex md:flex-row-reverse mt-10">
                <div class="md:w-1/3">
                    <div class="rounded-lg md:shadow-lg">
                        @livewire('map.small',['latitude' => $detailedInfo->latitude, 'longitude' => $detailedInfo->longitude])
                        @if($selectedDeputy)
                            <div class="hidden p-4 rounded-b-lg md:block"> 
                                <div class="text-gray-500 mb-2">
                                    {{__('선택된 라이너')}}
                                </div>
                                <div class="flex mb-4">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{$selectedDeputy->user->profile_photo_url}}" alt="{{$selectedDeputy->user->name}}">    
                                    <div class="m-2">
                                        <div>
                                            {{$selectedDeputy->user->name}}
                                        </div>
                                    </div>
                                </div>
                                <button class="w-full bg-green-700 text-white py-3 rounded" wire:click="payment({{$detailedInfo->id}},{{$selectedDeputy->id}})">{{number_format($selectedDeputy->amount)}}{{__('원 결제하기')}}</button>
                            </div>
                        @else
                            <div class="hidden p-4 rounded-b-lg md:block"> 
                                <div class="text-gray-500 mb-2">
                                    {{__('지원한 요청자')}}
                                </div>
                                @livewire('tool.swiper',['id'=>$detailedInfo->id])
                                @if($detailedInfo->deputy)
                                    <button class="w-full bg-green-700 text-white py-3 rounded" wire:click="checkApplicants()">지원자 리스트</button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="md:w-2/3">
                    <div class="text-sm text-gray-600">장소</div>
                    <div class=" text-xl">
                        @if($detailedInfo->placeName)
                            {{$detailedInfo->placeName}} {{$detailedInfo->detailedAddress}}
                        @else
                            {{$detailedInfo->addressName}} {{$detailedInfo->detailedAddress}}
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 mt-10">시간</div>
                    <div>
                        {{date('Y.m.d',strtotime($detailedInfo->reservedDatetime))}}
                        ({{$days[date('w',strtotime($detailedInfo->reservedDatetime))]}})
                        @if(date('h',strtotime($detailedInfo->reservedDatetime))>12)
                            {{__('오후')}}
                            {{date('h',strtotime($detailedInfo->reservedDatetime))-12}}{{__(':')}}{{date('i',strtotime($detailedInfo->reservedDatetime))}}
                        @else
                            {{__('오전')}}
                            {{date('h:i',strtotime($detailedInfo->reservedDatetime))}}
                        @endif
                    </div>
                    <div class="text-sm text-gray-600 mt-10">추가사항</div>
                    <div class="text-sm text-gray-700">
                        @if($detailedInfo->detailedMessage)
                            {{$detailedInfo->detailedMessage}}
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
    @elseif($showApplicants)
        <div class="text-green-700 font-bold my-5">
            요청한 라이너 리스트 보기
        </div>
        <div class="flex w-full text-lg mb-5 p-1">
            <div class="w-1/3 md:w-2/5">
                라이너
            </div>
            <div class="hidden md:block md:w-1/5">
                회원등급
            </div>
            <div class="w-1/3 md:w-1/5">
                줄서기경력
            </div>
            <div class="w-1/3 md:w-1/5">
                제시금액
            </div>
        </div>
        <div class="hidden md:block w-full border-t border-gray-200 mb-5"></div>
        @foreach($detailedInfo->applicants as $applicant)
            <div class="flex w-full mb-5 p-1 hover:bg-gray-200 cursor-pointer" wire:click="chooseApplicant({{$applicant->id}})">
                <div class="w-1/3 md:w-2/5 flex">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{$applicant->user->profile_photo_url}}" alt="{{$applicant->user->name}}">    
                    <div class="m-2">
                        {{$applicant->user->name}}
                    </div>
                </div>
                <div class="hidden md:block md:w-1/5">
                    @if($applicant->experienced->count()>99)
                        <div class="m-2 text-green-700">
                            {{__('베테랑')}}
                        </div>
                    @else
                        <div class="m-2">
                            {{__('일반회원')}}
                        </div>
                    @endif
                </div>
                <div class="w-1/3 md:w-1/5">
                    <div class="m-2">
                        {{$applicant->experienced->count()}}{{__('회')}}
                    </div>
                </div>
                <div class="w-1/3 md:w-1/5">
                    <div class="m-2">
                        {{number_format($applicant->amount)}}{{__('원')}}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-green-700 font-bold my-5">
            {{__('진행중인 요청내역 보기')}}
        </div>
        <div class="flex w-full p-2">
            <div class="w-1/2">{{__('줄서기장소')}}</div>
            <div class="w-1/4">{{__('현재 최저 제시금액')}}</div>
            <div class="w-1/4">{{__('희망 입장시간')}}</div>
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
                            @if($result->deputy)
                                {{number_format($result->deputy->amount)}}{{__('원')}}
                            @else
                                {{number_format($result->maximumCost)}}{{__('원')}}
                            @endif
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
        {{ $results->links() }}
    @endif
</div>