<div>
    @if($showDetail<>true)
        <div>
            <div class="text-green-700 font-bold my-5">
                {{__('예정된 서비스 내역 보기')}}
            </div>
            <div class="flex w-full p-2">
                <div class="w-1/2">{{__('줄서기장소')}}</div>
                <div class="w-1/4">{{__('결제금액')}}</div>
                <div class="w-1/4">{{__('희망 입장시간')}}</div>
            </div>
            <div class="py-2">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="sm:h-96">
                @if(count($results)>0)
                    @foreach($results as $result)
                        <div class="flex w-full p-2 text-gray-600 text-sm hover:bg-gray-200" wire:click="details({{$result->id}})">
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
                        예정된 서비스 내역이 없습니다
                    </div>
                @endif
            </div>
            {{ $results->links() }}
        </div>
    @else
        <div class="md:flex md:flex-row-reverse mt-10">
            <div class="md:w-1/3">
                <div class="rounded-lg md:shadow-lg">
                    @livewire('map.small',['latitude' => $detailedInfo->latitude, 'longitude' => $detailedInfo->longitude])
                    <div class="hidden p-4 rounded-b-lg md:block"> 
                        <div class="text-gray-500 mb-2">
                            {{__('선택된 라이너')}}
                        </div>
                        <div class="flex mb-4">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{$detailedInfo->selectedApplicant->user->profile_photo_url}}" alt="{{$detailedInfo->selectedApplicant->user->name}}">    
                            <div class="ml-2">
                                <div>
                                    {{$detailedInfo->selectedApplicant->user->name}}
                                </div>
                                <div class="text-green-500 text-sm flex" wire:click="chatStart({{$detailedInfo->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="arcs"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                    메세지 보내기
                                </div>
                            </div>
                        </div>
                        @if(strtotime(now())-strtotime($detailedInfo->updated_at)>900)
                            <button class="w-full bg-green-700 text-white py-3 rounded" wire:click="askToBeReceivedTheQueue({{$detailedInfo->id}})">{{__('줄을 넘겨받기')}}</button>
                        @else
                            <div class="grid gap-2 grid-cols-2">
                                <button class="w-full border-2 border-green-700 text-green-700 text-white py-3 rounded" wire:click="askCancelPayment({{$detailedInfo->id}})">{{__('결제취소')}}</button>
                                <button class="w-full bg-green-700 text-white py-3 rounded" wire:click="askToBeReceivedTheQueue({{$detailedInfo->id}})">{{__('줄을 넘겨받기')}}</button>
                            </div>
                        @endif
                        <x-jet-dialog-modal wire:model="cancelPaymentModal">
                            <x-slot name="title">
                                <span class="font-bold text-sm text-gray-600">{{ __('결제취소') }}</span>
                            </x-slot>

                            <x-slot name="content">
                                <span class="font-bold text-sm text-gray-600">{{__('정말로 결제를 취소 하시겠습니까?')}}<br>{{__('(결제취소시 예정내역의 정보들이 사라집니다.)')}}</span>
                            </x-slot>

                            <x-slot name="footer">
                                <div class="grid gap-2 grid-cols-2 m-2 text-white">
                                    <button wire:click="$toggle('cancelPaymentModal')" wire:loading.attr="disabled" class="p-2 rounded bg-gray-500">{{_('아니오')}}</button>
                                    <button wire:click="cancelPayment({{$detailedInfo->id}})"
                                            wire:loading.attr="disabled" class="p-2 rounded bg-green-700">{{_('예')}}</button>
                                </div>
                            </x-slot>
                        </x-jet-dialog-modal>
                        <x-jet-dialog-modal wire:model="doubleCheckModal">
                            <x-slot name="title">
                                <span class="font-bold text-sm text-gray-600">{{ __('줄 넘겨받기') }}</span>
                            </x-slot>

                            <x-slot name="content">
                                <span class="font-bold text-sm text-gray-600">{{__('라이너로 부터 줄을 넘겨 받으시겠습니까?')}}</span>
                            </x-slot>

                            <x-slot name="footer">
                                <div class="grid grid-cols-2 h-10 text-green-700">
                                    <button wire:click="$toggle('doubleCheckModal')" wire:loading.attr="disabled" class="font-bold border-r-2 border-gray-400">{{_('아니오')}}</button>
                                    <button wire:click="receivedQueue({{$detailedInfo->id}})"
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
                <div class="p-2 rounded-b-lg md:hidden">
                    @livewire('tool.bid.all', ['requestedId'=>$detailedInfo->id])
                </div>
            </div>
        </div>
    @endif
</div>