<div>
    <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
        <div class="text-2xl">    
            {{__('줄서기 요청내역')}}
        </div>
        <style>
            #swipe::-webkit-scrollbar{
                width:0px;
            }
        </style>
        <div id="swipe" class="mt-1 flex overflow-x-auto gap-4">
            <button type="button" wire:click="requested" class="{{ $type == 'requested' ? 'bg-gray-500 text-white':'bg-gray-200'}} min-w-max rounded-full py-2 px-4">진행중인 요청내역</button>
            <button type="button" wire:click="reserved" class="{{ $type == 'reserved' ? 'bg-gray-500 text-white':'bg-gray-200'}} min-w-max rounded-full py-2 px-4">예정된 서비스 내역</button>
            <button type="button" wire:click="completed" class="{{ $type == 'completed' ? 'bg-gray-500 text-white':'bg-gray-200'}} min-w-max rounded-full py-2 px-4">완료된 서비스 내역</button>
        </div>
    </div>
    
    <div class="hidden md:block w-full border-t border-gray-200"></div>    
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if($type == 'requested')
            @livewire('requested.requested')
        @elseif($type == 'reserved')
            @livewire('requested.reserved')
        @elseif($type == 'completed')
            @livewire('requested.completed')
        @endif
    </div>
</div>