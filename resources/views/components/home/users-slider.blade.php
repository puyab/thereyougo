@props(['profiles'])
@php
    $breakpoints = [
        0 => [
            'slidesPerView' => 1,
            'spaceBetween' => 3
        ],
        420 => [
            'slidesPerView' => 2.3,
            'spaceBetween' => 38,
        ],
        600 => [
            'centerMode' => true,
            'slidesPerView' => 3,
            'spaceBetween' => 30,
        ],
        900 => [
            'slidesPerView' => 4,
            'spaceBetween' => 50,
        ],
        1024 => [
            'slidesPerView' => 2.5,
            'spaceBetween' => 72,
        ],
        1200 => [
            'slidesPerView' => 3,
            'spaceBetween' => 72,
        ],
        1500 => [
            'slidesPerView' => 4,
            'spaceBetween' => 72,
        ],
        1700 => [
            'slidesPerView' => 4.3,
            'spaceBetween' => 72,
        ],
        1840 => [
            'slidesPerView' => 5,
            'spaceBetween' => 72,
        ],
    ];
@endphp
<Swiper class="w-full mx-auto max-w-[1920px]" :loop="true" :autoplay="@js(['delay' => rand(4000, 8000)])"
    :v-bind:modules="SwiperModules" :breakpoints="@js($breakpoints)">
    @foreach ($profiles as $profile)
        @php
            $pic_1 = $profile->getFirstMediaUrl('pic_1');
            $avatar = $profile->getFirstMediaUrl('avatar');
            if ($pic_1 === '' || $avatar === '') {
                continue;
            }
        @endphp
        <SwiperSlide key="{{ $profile->id }} ">
            <div class="w-[187px] lg:w-[375px] relative pb-[48p] flex flex-col gap-1">
                <figure class="relative w-full h-[102px] lg:h-[205px]">
                    <img class="w-full h-full object-fill" loading="lazy"
                        src="{{ $pic_1 !== '' ? $pic_1 : asset('images/not-found.jpg') }}"
                        alt="{{ $profile->first_name }} {{ $profile->last_name }}" />
                </figure>
                <div class="w-full h-max flex flex-row gap-2 items-start justify-between lg:px-6">
                    <figure
                        class="relative min-w-[48px] h-[50px] lg:min-w-[97px] lg:h-[100px] rounded-full overflow-hidden border-[1px] border-white -translate-y-[30px] lg:-translate-y-[54px]">
                        <img class="w-full h-full absolute inset-0" loading="lazy"
                            src="{{ $avatar !== '' ? $avatar : asset('images/not-found.jpg') }}"
                            alt="{{ $profile->first_name }} {{ $profile->last_name }}" />
                    </figure>
                    <div class="w-full flex flex-col items-start justify-start">
                        <span class="font-light text-xs sm:text-sm md:text-xl text-[#292D32]">{{ $profile->first_name }}
                            {{ $profile->last_name }}.</span>
                        <span
                            class="w-max max-w-[138px] lg:max-w-[210px] text-xs sm:text-sm md:text-base text-[#292D32]">{{ $profile->role }},
                            {{ $profile->company }}</span>
                        {{--          <span class="w-max max-w-[227px] text-base text-[#292D32]">{{$profile->location}}</span> --}}
                    </div>

                </div>
            </div>
        </SwiperSlide>
    @endforeach
</Swiper>