<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('줄서기 요청내역') }}
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    @livewire('button', ['type'=>'reserved'])
    <div class="bg-white mt-2 p-4 rounded-lg" wire:click="requested">
        {{$result}}
    </div>
</div>