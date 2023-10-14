@props(['profiles'])
@php
$breakpoints = [
    0 => [
        'slidesPerView' => 1
    ],
    600 => [
        'slidesPerView' => 2,
        'spaceBetween' => 30,
    ],
    900 => [
        'slidesPerView' => 3,
        'spaceBetween' => 50,
    ],
    1024 => [
        'slidesPerView' => 4,
        'spaceBetween' => 72
    ]
];
@endphp
  <Swiper class="w-full mx-auto max-w-[1920px]" :loop="@js(true)" :autoplay="@js(2000)" v-bind:modules="SwiperModules" :breakpoints="@js($breakpoints)">
    @foreach($profiles as $profile)
      <SwiperSlide key="{{$profile->id}} "
                     class="w-full min-w-[300px] relative pb-[48p] flex flex-col gap-1">
        <figure class="relative w-full h-[205px]">
          <img class="w-full h-full object-fill" src="{{$profile->getFirstMediaUrl('pic_1')}}"
               alt="{{$profile->first_name}} {{$profile->last_name}}"/>
        </figure>
        <div class="w-full pl-[8rem] flex flex-col items-start justify-start">
          <span class="font-light text-xl text-[#292D32]">{{$profile->first_name}} {{$profile->last_name}}.</span>
          <span class="w-max max-w-[227px] text-base text-[#292D32]">{{$profile->role}}</span>
        </div>
        <figure
          class="absolute w-[97px] h-[100px] -bottom-0 left-6 rounded-full overflow-hidden border-[1px] border-white">
          <img class="w-full h-full object-fill" src="{{$profile->getFirstMediaUrl('avatar')}}"
               alt="{{$profile->first_name}} {{$profile->last_name}}"/>
        </figure>
      </SwiperSlide>
    @endforeach
  </Swiper>
