<div>
    <div class="swiper w-full h-10 mb-2">
        <div class="swiper-wrapper">
            @if(count($applicants)>0)
                @foreach($applicants as $applicant)
                    <div class="swiper-slide">
                        <div class="flex min-w-max">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{$applicant->user->profile_photo_url}}" alt="{{$applicant->user->name}}">
                            <div class="m-2 font-bold">
                                {{$applicant->user->name}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                지원한 요청자가 없습니다
            @endif
        </div>
    </div>
    <script>
        const swiper = new Swiper('.swiper', {
            slidesPerView: 3,
            spaceBetween: 10,
            grabCursor: true,
            freeMode: true,
        });
    </script>
</div>