<div>
    <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
        <div class="text-2xl">    
            {{__('줄서기 알바내역')}}
        </div>
        <style>
            #swipe::-webkit-scrollbar{
                width:0px;
            }
        </style>
        <div id="swipe" class="mt-1 flex overflow-x-auto gap-4">
            <button type="button" wire:click="apply" class="{{ $status == 'apply' ? 'bg-gray-500 text-white':'bg-gray-200'}} min-w-max rounded-full py-2 px-4">줄서기지원내역</button>
            <button type="button" wire:click="selected" class="{{ $status == 'selected' ? 'bg-gray-500 text-white':'bg-gray-200'}} min-w-max rounded-full py-2 px-4">진행중인 알바내역</button>
            <button type="button" wire:click="completed" class="{{ $status == 'completed' ? 'bg-gray-500 text-white':'bg-gray-200'}} min-w-max rounded-full py-2 px-4">완료된 알바내역</button>
        </div>
    </div>
    
    <div class="hidden md:block w-full border-t border-gray-200"></div>    
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if($status == 'apply')
            @livewire('apply.apply')
        @elseif($status == 'selected')
            @livewire('apply.selected')
        @elseif($status == 'completed')
            @livewire('apply.completed')
        @endif
    </div>
</div>