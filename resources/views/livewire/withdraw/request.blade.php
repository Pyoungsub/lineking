<div>
    <div class="text-gray-600 mb-6">출금신청을 위해 아래의 정보를 입력해주세요.</div>
    <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4 mb-4">
        <div>
            <div class="relative mb-6">
                <div id="balance" class="h-10 pl-3 pt-2 border border-green-700 rounded-md shadow-sm peer w-full">{{number_format($balance)}}{{__('원')}}</div>
                <label for="balance" class="absolute text-green-700 -top-4 text-xs left-1 cursor-text">현재보유금액</label>
            </div>
            <div class="relative mb-6">
                <x-jet-input id="withdrawal" wire:model.lazy="withdrawal" type="text" class="peer w-full" autocomplited="off" />
                <label for="withdrawal" class="absolute text-gray-500 {{$withdrawal<>null ? '-top-4 text-xs left-1': 'left-1 top-2'}} cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all duration-200">출금요청금액(단위:원)</label>
                @error('withdrawal') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="relative">
                <div id="afterFees" wire:model="afterFees" class="h-10 pl-3 pt-2 border border-green-700 rounded-md shadow-sm peer w-full">
                    @if(is_numeric($afterFees) && $afterFees>0)
                        {{number_format($afterFees)}}{{__('원')}}
                    @endif
                </div>
                <label for="afterFees" class="absolute text-green-700 {{is_numeric($afterFees) && $afterFees>0 ? '-top-4 text-xs left-1': 'left-1 top-2'}} cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all duration-200">실제출금금액(수수료제외)</label>
                <div class="text-xs text-green-700">*수수료는 회원 등급에 따라 달라집니다.</div>
            </div>
        </div>
        <div>
            <div class="relative mb-6">
                <select id="bank_id" wire:model="bank_id" class="peer border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm peer w-full">
                    @foreach($banks as $bank)
                        @if($loop->first)
                            <option value=""></option>
                        @endif
                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                    @endforeach
                </select>
                <label for="bank_id" class="absolute text-gray-500 {{$bank_id<>null ? '-top-4 text-xs left-1': 'left-1 top-2'}} cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all duration-200">은행설정</label>
                @error('bank_id') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div class="relative mb-6">
                <x-jet-input id="accountHolder" wire:model="accountHolder" type="text" class="peer w-full" autocomplited="off" />
                <label for="accountHolder" class="absolute text-gray-500 {{$accountHolder<>null ? '-top-4 text-xs left-1': 'left-1 top-2'}} cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all duration-200">예금주</label>
                @error('accountHolder') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
                <div class="text-xs text-green-700">*가입된 성명과 예금주 이름이 동일하지 않으면 관리자에게 문의주셔야 출금이 가능합니다.</div>
            </div>
            <div class="relative">
                <x-jet-input id="bankAccount" wire:model="bankAccount" type="text" class="peer w-full" autocomplited="off" />
                <label for="bankAccount" class="absolute text-gray-500 {{$bankAccount<>null ? '-top-4 text-xs left-1': 'left-1 top-2'}} cursor-text peer-focus:text-xs peer-focus:-top-4 transition-all duration-200">계좌번호</label>
                @error('bankAccount') <span class="text-sm text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <x-jet-button wire:click="withdrawRequest" class="bg-green-700 py-4 px-8">
            출금요청하기
        </x-jet-button>
    </div>
</div>
