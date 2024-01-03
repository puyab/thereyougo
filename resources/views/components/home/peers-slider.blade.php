<!-- @props(['profiles'])
@php
    $breakpoints = [
        0 => [
            'slidesPerView' => 2,
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
@endphp -->
<Swiper class="w-full mx-auto max-w-[1920px]" :spaceBetween="6" :loop="true" :autoplay="@js(['delay' => rand(4000, 8000)])"
    :v-bind:modules="SwiperModules" :breakpoints="@js($breakpoints)" :speed="2000">
    <SwiperSlide>
        <a class="logo-item" href="#"><img src="images/logo1.png" alt=""></a>
    </SwiperSlide>
    <SwiperSlide>
        <a class="logo-item" href="#"><img src="images/logo2.png" alt=""></a>
    </SwiperSlide>
    <SwiperSlide>
        <a class="logo-item" href="#"><img src="images/logo3.png" alt=""></a>
    </SwiperSlide>
    <SwiperSlide>
        <a class="logo-item" href="#"><img src="images/logo4.png" alt=""></a>
    </SwiperSlide>
    <SwiperSlide>
        <a class="logo-item" href="#"><img src="images/logo5.png" alt=""></a>
    </SwiperSlide>
</Swiper>
