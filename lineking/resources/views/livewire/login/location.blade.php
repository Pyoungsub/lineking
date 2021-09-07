<div>
    <select id="state" name="state" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" wire:model="selectedState" required>
        <option value=""></option>
        @foreach($states as $state)
        <option value="{{$state->id}}">{{$state->state_name}}</option>
        @endforeach
    </select>
    @if(!is_null($selectedState))
    <select id="city" name="city" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" required>
        <option value=""></option>
        @foreach($cities as $city)
        <option value="{{$city->id}}">{{$city->city_name}}</option>
        @endforeach
    </select>
    @endif
</div>