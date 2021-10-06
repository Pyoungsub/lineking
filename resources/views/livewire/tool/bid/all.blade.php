<div>
    @if($offeredAmount)
        <div class="flex justify-between mb-1">
            <div>
                <div class="text-gray-500">제시된 금액</div>
                <div>내 제시금액</div>
                <div>{{number_format($offeredAmount->amount)}}원</div>
                <div>현재 최저 제시 금액</div>
                <div>{{number_format($result->deputy->amount)}}원</div>
            </div>
            <div class="relative w-20">
                <div class="flex absolute bottom-0 right-0 cursor-pointer" wire:click="$emit('cancelOfferModal')">
                    <p class="text-sm font-bold text-cancel">입찰취소</p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#7FC7FD" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                </div>
            </div>
        </div>
    @else
        <div class="text-gray-500">제시된 금액</div>
        <div class="flex pt-1">
            @if($result->deputy)
                <div class="pr-1 font-bold text-green-700">
                    <p>현재 최저 제시 금액</p>
                    <p>{{number_format($result->deputy->amount)}}원</p>
                </div>
            @else
                <div class="pr-1 font-bold text-green-700">
                    지원한 요청자가 없습니다.
                </div>
            @endif
        </div>
        <div class="pr-1 font-bold text-green-700">
            입장 요청자 최대 예산: {{number_format($result->maximumCost)}}원
        </div>
    @endif
    <input type="text" class="{{$showInput ? '' : 'hidden'}} border-gray-300 focus:border-green-700 focus:ring focus:ring-green-700 focus:ring-opacity-50 rounded-md shadow-sm w-full" wire:model.lazy="offerAmount" wire:keydown.enter="submit" placeholder="제시금액" />
    @error('offerAmount') <span class="error">{{ $message }}</span> @enderror
    <button class="h-10 bg-green-700 text-white w-full mt-1 rounded-md" wire:click="submit">{{$buttonContent}}</button>

    <!-- modal start -->
    @livewire('tool.bid.cancel-modal', ['userId'=>$userId, 'requestedId'=>$requestedId])
</div>
