<div>
    <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
        <div class="text-2xl">
            {{__('메세지내역')}}
        </div>
    </div>
    <div class="hidden md:block w-full border-t border-gray-200"></div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <div class="hidden sm:block">
                @livewire('tool.messages.rooms')
            </div>
            <div class="lg:col-span-2">
                <div class="h-14 p-4 bg-gray-200">
                    @if($reservation)
                        @if($reservation->placeName)
                            {{$reservation->placeName}} {{$reservation->detailedAddress}}
                        @else
                            {{$reservation->addressName}} {{$reservation->detailedAddress}}
                        @endif
                    @endif
                </div>
                <div id="messagesDiv" class="relative h-96 border border-gray-100 overflow-y-auto">
                    @if(count($reservation->chatHistory)>0)
                        @foreach($reservation->chatHistory as $chat)
                            @if($chat->user_id == Auth::user()->id)
                                <div class="flex items-end justify-end">
                                    <div class="text-sm text-gray-500 mb-2">
                                        {{$chat->created_at->diffForHumans()}}
                                    </div>
                                    <div class="text-sm text-white bg-green-700 rounded-lg rounded-br-none p-2 m-2">
                                        {{$chat->message}}
                                    </div>
                                </div>
                            @else
                                <div class="flex items-end ml-2">
                                    <img class="mt-1 h-10 w-10 rounded-full object-cover" src="{{$chat->user->profile_photo_url}}" alt="{{$chat->user->name}}">    
                                    <div class="text-sm bg-gray-200 rounded-lg rounded-bl-none p-2 ml-2">
                                        {{$chat->message}}
                                    </div>
                                    <div class="text-sm text-gray-500 mb-2">
                                        {{$chat->created_at->diffForHumans()}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        채팅을 시작할 수 있습니다.
                    @endif
                </div>
                <script>
                    let objDiv = document.getElementById("messagesDiv");

                    document.addEventListener("DOMContentLoaded", function(){
                        scrollToBottom();
                    });

                    window.addEventListener('modifyScrollPosition', event => {
                        messageReceived();
                    });

                    function scrollToBottom(){
                        objDiv.scrollTop = objDiv.scrollHeight;
                    };
                    function messageReceived(){
                        objDiv.scrollTop += 52;
                    }
                </script>
                <div class="w-full">
                    <x-jet-input type="text" wire:model.lazy="message" wire:keydown.enter="sendMessage" class="w-full" placeholder="메세지를 입력하세요" />
                </div>
            </div>
        </div>
    </div>
</div>