<form wire:submit.prevent="requestingSubstitute" class="md:col-span-1 justify-between">
    @csrf
    <div class="relative">
        <x-jet-input id="fullAddress" type="text" class="mt-1 block w-full" wire:model.lazy="fullAddress" autocomplete="fullAddress" placeholder="위치입력" />
        @if($trigger<>null)
        <div class="absolute mt-2 left-0 bg-white w-full rounded-lg py-3 px-6 z-10 text-sm">
            @foreach($locations['documents'] as $index => $location)
                @if($location['road_address_name'])
                    <div class="mb-1 cursor-pointer" wire:mouseover="getAMap({{$location['x']}},{{$location['y']}})" wire:click="getAddressInfo('{{$location['road_address_name']}}','{{$location['place_name']}}',{{$location['x']}},{{$location['y']}})">
                        {{$location['road_address_name']}}
                        @if($location['place_name'])
                            <br>{{$location['place_name']}}
                        @endif
                    </div>
                @else
                    <div class="mb-1 cursor-pointer" wire:mouseover="getAMap({{$location['x']}},{{$location['y']}})" wire:click="getAddressInfo('{{$location['address_name']}}','{{$location['place_name']}}',{{$location['x']}},{{$location['y']}})">
                        {{$location['address_name']}}
                        @if($location['place_name'])
                            <br>{{$location['place_name']}}
                        @endif
                    </div>
                @endif
                <hr>
            @endforeach
            @if($totalPage)
                {{$totalPage}}
            @endif
        </div>
        @endif
        <x-jet-input-error for="fullAddress" class="mt-2" />
    </div>
    <x-jet-input id="detailedAddress" type="text" class="mt-1 block w-full" wire:model.lazy="detailedAddress" autocomplete="detailedAddress" placeholder="세부장소" />
    <x-jet-input-error for="detailedAddress" class="mt-2" />
    <div class="sm:flex">
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
        <div class="block">
            <x-jet-input id="reservedDate" type="text" class="mt-1 w-full" wire:model.lazy="reservedDate" autocomplete="reservedDate" placeholder="예약날짜" />
            <x-jet-input-error for="reservedDate" class="mt-2" />
        </div>
        <script>
            var picker = new Pikaday({ 
                field: document.getElementById('reservedDate'),
                minDate: new Date(),
                format: 'yyyy-MM-dd',
                toString(date, format) {
                    let day = ("0" + date.getDate()).slice(-2);
                    let month = ("0" + (date.getMonth() + 1)).slice(-2);
                    let year = date.getFullYear();
                    return `${year}-${month}-${day}`;
                }
            });
        </script>
        <div class="relative">
            <x-jet-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <x-jet-input id="reservedTime" type="text" class="mt-1 w-full static" wire:click="$toggle('timeList')" wire:model.lazy="reservedTime" autocomplete="reservedTime" placeholder="예약시간" />
                </x-slot>
                <x-slot name="content">
                    <div style="height:200px;overflow-y:scroll;">
                    @for($i = 0; $i < 24; $i++)
                        @if($i>9)
                            <x-jet-dropdown-link wire:click="inputTime('{{$i}}:00')">
                                {{$i}}:00
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link wire:click="inputTime('{{$i}}:30')">
                                {{$i}}:30
                            </x-jet-dropdown-link>
                        @else
                            <x-jet-dropdown-link wire:click="inputTime('0{{$i}}:00')">
                                0{{$i}}:00
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link wire:click="inputTime('0{{$i}}:30')">
                                0{{$i}}:30
                            </x-jet-dropdown-link>
                        @endif
                    @endfor
                    </div>
                </x-slot>
            </x-jet-dropdown>
            <x-jet-input-error for="reservedTime" class="mt-2" />
        </div>
    </div>
    <div class="relative">
        <x-jet-input id="maximumCost" type="text" class="mt-1 block w-full" wire:model="maximumCost" autocomplete="maximumCost" placeholder="최대금액" />
        <i class="fas fa-won-sign fa-sm absolute top-0 right-0" style="padding:12px"></i>
    </div>
    <x-jet-input-error for="maximumCost" class="mt-2" />
    <textarea id="detailedMessage" wire:model.lazy="detailedMessage" style="resize:none" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" rows="5" placeholder="추가사항"></textarea>
    <x-jet-input-error for="detailedMessage" class="mt-2" />
    <x-jet-input-error for="extraError" class="mt-2" />
    <button type="submit" class="w-full mt-1 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <span>{{ __('요청하기') }}</span>
    </button>
</form>
