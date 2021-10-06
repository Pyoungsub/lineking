<x-jet-dialog-modal wire:model="offerCancel">
    <x-slot name="title">
        <span class="font-bold text-sm text-gray-600">{{ __('정말로 입찰을 취소 하시겠습니까?') }}</span>
    </x-slot>

    <x-slot name="content">
        <span class="font-bold text-sm text-gray-600">{{__('(입찰 취소시 제시내역의 정보들이 사라집니다.)')}}</span>
    </x-slot>

    <x-slot name="footer">
        <div class="grid grid-cols-2 h-10 text-green-700">
            <button wire:click="$toggle('offerCancel')" wire:loading.attr="disabled" class="font-bold border-r-2 border-gray-400">{{_('아니오')}}</button>
            <button wire:click="cancelThisOffer"
                    wire:loading.attr="disabled" class="font-bold">{{_('예')}}</button>
        </div>
    </x-slot>
</x-jet-dialog-modal>