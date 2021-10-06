<div>
    <div class="text-green-700 font-bold my-5">
        {{__('완료된 알바내역 보기')}}
    </div>
    <div class="flex w-full p-2">
        <div class="w-1/2">{{__('줄서기장소')}}</div>
        <div class="w-1/4">{{__('결제금액')}}</div>
        <div class="w-1/4">{{__('입장시간')}}</div>
    </div>
    <div class="py-2">
        <div class="w-full border-t border-gray-200"></div>
    </div>
    <div class="sm:h-96">
        @if(count($results)>0)
            @foreach($results as $result)
                <div class="flex w-full p-2 text-gray-600 text-sm hover:bg-gray-200 cursor-pointer">
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
    {{ $results->links() }}
</div>