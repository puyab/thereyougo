@props(['profiles'])
@php
  $breakpoints = [
      0 => [
          'slidesPerView' => 1
      ],
      420 => [
        'slidesPerView' => 1.2
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
<Swiper class="w-full mx-auto max-w-[1920px]" :spaceBetween="24" :loop="true" :autoplay="true" v-bind:modules="SwiperModules"
        :breakpoints="@js($breakpoints)">
  @foreach($profiles as $profile)
    @php
      $pic_1 = $profile->getFirstMediaUrl('pic_1');
      $avatar = $profile->getFirstMediaUrl('avatar');
      if($pic_1 === '' || $avatar === '')
      continue;
    @endphp
    <SwiperSlide key="{{$profile->id}} "
                 class="w-full min-w-[400px] relative pb-[48p] flex flex-col gap-1">
      <figure class="relative w-full h-[205px]">
        <img class="w-full h-full object-fill" src="{{ $pic_1 !== '' ? $pic_1 : asset('images/not-found.jpg')}}"
             alt="{{$profile->first_name}} {{$profile->last_name}}"/>
      </figure>
      <div class="w-full h-max flex flex-row gap-2 items-start justify-between">
        <figure
          class="min-w-[97px] max-w-[100px] h-[100px] rounded-full overflow-hidden border-[1px] border-white -translate-y-[30px]">
          <img class="w-full h-full object-fill" src="{{$avatar !== '' ? $avatar : asset('images/not-found.jpg')}}"
               alt="{{$profile->first_name}} {{$profile->last_name}}"/>
        </figure>
        <div class="w-full flex flex-col items-start justify-start">
          <span class="font-light text-xl text-[#292D32]">{{$profile->first_name}} {{$profile->last_name}}.</span>
          <span class="w-max max-w-[227px] text-base text-[#292D32]">{{$profile->role}}, {{$profile->company}}</span>
{{--          <span class="w-max max-w-[227px] text-base text-[#292D32]">{{$profile->location}}</span>--}}
        </div>

      </div>
    </SwiperSlide>
  @endforeach
</Swiper>
