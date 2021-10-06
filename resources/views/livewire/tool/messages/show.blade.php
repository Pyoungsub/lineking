<div>
    <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
        <div class="text-2xl">
            {{__('메세지내역')}}
        </div>
    </div>
    <div class="hidden md:block w-full border-t border-gray-200"></div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                @livewire('tool.messages.rooms')
            </div>
            <div class="lg:col-span-2">
                <div>내 메세지</div>
                <div>친구나 그룹에 비공개 사진과 메세지를 보내보세요.</div>
            </div>
        </div>
    </div>
</div>