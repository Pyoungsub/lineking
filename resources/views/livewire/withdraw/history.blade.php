<div>
    <div class="text-green-700 font-bold my-5">
        {{__('출금내역 확인하기')}}
    </div>
    <div class="text-gray-500 mb-10">
        {{__('출금내역을 확인하기위해 아래의 정보를 입력해주세요.')}}
    </div>
    <div class="text-sm text-gray-500">
        기간조회
    </div>
    <div class="mb-5 lg:w-1/2">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
            <x-jet-input id="start" type="text" class="mt-1" wire:model.lazy="startDate" autocomplete="off" placeholder="출금일자(부터)" />
            <x-jet-input id="end" type="text" class="mt-1" wire:model.lazy="endDate" autocomplete="off" placeholder="출금일자(까지)" />
            <button wire:click="search" class="text-white bg-green-700 rounded-lg py-2 col-span-2 sm:col-span-1">조회하기</button>
        </div>
        <script>
            var startDate,
            endDate,
            updateStartDate = function() {
                startPicker.setStartRange(startDate);
                endPicker.setStartRange(startDate);
                endPicker.setMinDate(startDate);
            },
            updateEndDate = function() {
                startPicker.setEndRange(endDate);
                startPicker.setMaxDate(endDate);
                endPicker.setEndRange(endDate);
            },
            startPicker = new Pikaday({
                field: document.getElementById('start'),
                toString(date, format) {
                    let day = ("0" + date.getDate()).slice(-2);
                    let month = ("0" + (date.getMonth() + 1)).slice(-2);
                    let year = date.getFullYear();
                    return `${year}-${month}-${day}`;
                },
                minDate: new Date(),
                maxDate: new Date(2020, 12, 31),
                onSelect: function() {
                    startDate = this.getDate();
                    updateStartDate();
                }
            }),
            endPicker = new Pikaday({
                field: document.getElementById('end'),
                minDate: new Date(),
                maxDate: new Date(2020, 12, 31),
                toString(date, format) {
                    let day = ("0" + date.getDate()).slice(-2);
                    let month = ("0" + (date.getMonth() + 1)).slice(-2);
                    let year = date.getFullYear();
                    return `${year}-${month}-${day}`;
                },
                onSelect: function() {
                    endDate = this.getDate();
                    updateEndDate();
                }
            }),
            _startDate = startPicker.getDate(),
            _endDate = endPicker.getDate();

            if (_startDate) {
                startDate = _startDate;
                updateStartDate();
            }

            if (_endDate) {
                endDate = _endDate;
                updateEndDate();
            }
        </script>
        
        <x-jet-input-error for="startDate" class="mt-2" />
        <x-jet-input-error for="endDate" class="mt-2" />
    </div>
    
    @if($results)
        @if(count($results)>0)
            <div class="grid grid-cols-5 mb-2">
                <div>신청날짜</div>
                <div>출금금액</div>
                <div>실수령액</div>
                <div>계좌정보</div>
                <div>상태</div>
            </div>
            <div class="hidden md:block w-full border-t border-gray-200 mb-2"></div>
            @foreach($results as $result)
                <div>
                {{$result->created_at}}
                {{$result->withdraw_amount}}
                {{$result->afterFees}}
                {{$result->bank_id}}
                {{$result->accountHolder}}
                {{$result->bankAccount}}
                @if($result->created_at == $result->updated_at)
                    {{__('/대기/')}}
                @else
                    {{$result->updated_at}}
                @endif
                </div>
            @endforeach
        @else
            조회 결과가 없습니다
        @endif
    @endif
</div>