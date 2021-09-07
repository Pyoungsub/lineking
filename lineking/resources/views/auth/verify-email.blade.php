<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('줄왕에 오신 것을 환영합니다! 입력하신 이메일 주소에 인증 이메일을 보냈습니다. 이메일 안에 있는 확인 버튼을 눌러 회원가입을 완료해 주시기 바랍니다. 만약 이메일을 받지 못하셨다면 아래 단추를 눌러 다시 한번 시도해 주시기 바랍니다.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('인증 이메일을 다시 보냈습니다.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('인증 이메일 다시 보내기') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('로그아웃') }}
                </button>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
