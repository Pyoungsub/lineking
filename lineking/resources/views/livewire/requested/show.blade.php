<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('줄서기 요청내역') }}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    @livewire('button', ['type'=>$type])
    <div class="bg-white mt-2 p-4 rounded-lg">  
        @if($totalRecords>0)
            <h2 class="text-green-700 font-bold">{{__('진행중인 요청 내역 보기')}}</h2>
            <div class="gap-4 mt-2 block md:flex">
                <div class="font-bold w-full md:w-1/2">
                    {{__('줄 서기 장소')}}
                </div>
                <div class="font-bold hidden w-full md:w-1/4 md:flex">
                    {{__('현재 최저 제시 금액')}}
                </div>
                <div class="font-bold hidden w-full md:w-1/4 md:flex">
                    {{__('희망 입장 시간')}}
                </div>
            </div>
            <x-jet-section-border />
            <div wire:loading.delay.class="opacity-50">
                @foreach($results as $result)
                    <div @if($loop->last) id="last_record" @endif class="gap-4 cursor-pointer mb-2 md:flex" wire:click="details({{$result->id}})">
                        <div class="w-full md:w-1/2">
                            @if($result->placeName)
                                {{$result->placeName}} {{$result->detailedAddress}}
                            @else
                                {{$result->addressName}} {{$result->detailedAddress}}
                            @endif
                        </div>                    
                        <div class="text-green-700 md:w-1/4 md:inline-flex">
                            @if($result->deputy <> null)
                                {{number_format($result->deputy->amount)}}
                            @else
                                {{number_format($result->maximumCost)}}
                            @endif
                            {{__('원')}}
                        </div>
                        <div class="md:w-1/4 md:inline-flex">
                            {{substr($result->reservedDatetime,0,10)}}
                            ({{$days[date('w',strtotime($result->reservedDatetime))]}})
                            {{substr($result->reservedDatetime,10,-3)}}입장
                        </div>
                    </div>
                    <div class="block md:hidden"><hr></div>
                @endforeach
            </div>
            @if($loadAmount >= $totalRecords)
                <p class="text-gray-500 font-bold text-center mt-10 my-10 text-xs">모든 자료를 확인 했습니다</p>
            @endif
        @else
            <h2 class="text-green-700 font-bold">{{__('진행중인 요청 내역이 없습니다')}}</h2>    
        @endif
    </div>
    <script>
        const lastRecord = document.getElementById('last_record')
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry =>{
                if(entry.isIntersecting){
                    @this.loadMore()
                }
            })
        })

        observer.observe(lastRecord)
    </script>
</div>