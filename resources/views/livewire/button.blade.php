<div class="mt-1 flex overflow-x-auto">
    <button type="button" wire:click="requested" class="{{$type == 'requested' ? 'bg-gray-500 text-white':'bg-white'}} min-w-max rounded-full py-2 px-4">진행중인 요청내역</button>
    <button type="button" wire:click="reserved" class="{{$type == 'reserved' ? 'bg-gray-500 text-white':'bg-white'}} min-w-max rounded-full py-2 px-4">예정된 서비스 내역</button>
    <button type="button" wire:click="completed" class="{{$type == 'completed' ? 'bg-gray-500 text-white':'bg-white'}} min-w-max rounded-full py-2 px-4">완료된 서비스 내역</button>
</div>