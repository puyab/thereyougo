@php
use App\Models\Profile;
$profile = auth()->user()->profile;
$images = [];
foreach (['avatar', 'pic_1', 'pic_2', 'pic_3'] as $collection) {
$images[$collection] = $profile->getFirstMediaUrl($collection);
}
$refs_count = (string) Profile::query()
->where('referred_from', $profile->referral_code)
->count();
$refs_size = strlen($refs_count);
if ($refs_size
< 3) { for ($i=0; $i < 3 - $refs_size; $i++) { $refs_count='0' . $refs_count; } } @endphp <x-navbar />
<section class="w-full h-max bg-[#D29A9A80] flex flex-col-reverse lg:flex-row items-center justify-between lg:gap-20 gap-5 px-10 lg:px-20 pb-[52.5px] lg:pb-[105px]">
  <div class="w-full h-max flex flex-col items-start justify-start gap-8 max-w-[600px]">
    <h2 class="font-normal text-2xl sm:text-3xl md:text-4xl lg:text-6xl text-[#292D32] hidden lg:block">Start
      referring
      your friends
      to
      win the dream office.</h2>
    <Link href="{{ route('referral_code') }}">
    <x-button class="mx-auto lg:mx-0">Refer your friends now</x-button>
    </Link>
  </div>
  <x-splade-data default="{open: false}">
    <div @click="data.open = true" class="relative w-full max-w-[670px]">
      <figure class="w-full h-max">
        <img class="w-full min-h-[250px] lg:min-h-none aspect-auto" src="{{ asset('images/dream.png') }}" />
      </figure>
      <div class="absolute w-full h-full inset-0 flex items-center justify-center cursor-pointer">
        <div class="w-max h-max flex items-center justify-center bg-white rounded-[4999px] border-[1px] border-black py-1.5 px-3.5 md:py-3 md:px-7">
          <span class="text-black text-[8px] font-inter sm:text-lg md:text-xl lg:text-2xl font-semibold">Watch the
            video</span>
        </div>
      </div>
    </div>
    <div v-if="data.open" class="fixed inset-0 bg-black/30 z-50 flex items-center justify-center">
      <iframe class="w-11/12 h-5/6 border-none outline-none rounded-xl z-10" src="https://www.youtube.com/embed/1wLEL4w7Zuc?si=0hnMcOOhEoMI_Jmu&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      <div class="absolute inset-0 bg-transparent z-0" @click="data.open = false"></div>
    </div>
  </x-splade-data>
  <h2 class="font-normal text-3xl md:text-4xl lg:text-6xl text-[#292D32] lg:hidden max-w-[304px] mr-auto ml-0">Start
    referring
    your friends
    to
    win the dream office.</h2>
</section>
<section class="w-full px-10 lg:px-20 py-[20.5px] lg:py-[51px] flex flex-col gap-6 lg:gap-11 lg:mx-auto">
  <h2 class="font-normal text-[#292D32] text-3xl md:text-4xl lg:text-6xl">What happens now?</h2>
  <div class="w-full h-max flex flex-col gap-6 font-light text-xl md:text-2xl lg:text-3xl">
    <span>1- Complete any missing informations from your profile and wait our team to approve you.</span>
    <span>2- Refer your friends and check the tracker below to increase the chances of winning the Dream Office. You
      will be notified via weekly emails in regards of who’s ahead in winning the 2-weeks stay in Italy.</span>
    <span>3- Be ready to start travelling for $0/night when we open for swaps! You’ll be notified via email.</span>
  </div>
</section>
<section class="w-full h-max mx-auto px-10 lg:px-20 pb-[41px] lg:py-[82px] flex flex-col items-start justify-start">
  <div class="relative w-max max-w-full mx-auto h-max lg:h-[425px] lg:mt-[82px] lg:max-w-5xl hidden #grid grid-cols-1 lg:grid-cols-2 gap-4 place-items-center place-content-center data-[safari=true]:h-[1100px]  data-[safari=true]:lg:h-max" :data-safari="window.navigator.userAgent.indexOf('Safari') !== -1">
    <figure class="w-full h-full min-w-[364px] min-h-[202px]">
      <img class="w-full h-full object-fill" src="{{ $images['pic_1'] === '' ? asset('images/not-found.jpg') : $images['pic_1'] }}" />
    </figure>
    <div class="w-full h-max grid grid-cols-1 gap-5 place-content-center place-items-center">
      <figure class="w-full min-w-[364px] h-[202px] max-h-[202px]">
        <img class="w-full h-full object-fill" src="{{ $images['pic_2'] === '' ? asset('images/not-found.jpg') : $images['pic_2'] }}" />
      </figure>
      <figure class="w-full min-w-[364px] h-[202px] max-h-[202px]">
        <img class="w-full h-full object-fill" src="{{ $images['pic_3'] === '' ? asset('images/not-found.jpg') : $images['pic_3'] }}" />
      </figure>
    </div>
    <div class="w-full h-[202px] flex items-center justify-center lg:rounded-full lg:overflow-hidden lg:w-[275px] lg:h-[265px] lg:border-[3px] lg:border-white lg:absolute z-20 left-0 top-[50%]">
      <figure class="w-full h-full min-w-[364px] min-h-[202px] lg:min-w-[unset] lg:min-h-[unset] lg:w-[150%] lg:h-[120%]">
        <img class="w-full h-full object-fill" src="{{ $images['avatar'] === '' ? asset('images/not-found.jpg') : $images['avatar'] }}" />
      </figure>
    </div>
    <div class="w-full flex flex-col gap-2 mb-2 lg:mb-0 lg:ml-[38rem] font-light text-xl md:text-2xl lg:text-4xl text-[#292D32]">
      <span>{{ $profile->first_name }} {{ $profile->last_name }}.</span>
      <span>{{ $profile->role }}, {{ $profile->company }}</span>
      <span>{{ $profile->location }}</span>
    </div>
  </div>
  <div class="#lg:mt-[11rem] w-full flex flex-col-reverse gap-4 lg:flex-row lg:gap-8 lg:items-center lg:justify-start">
    <div class="w-max max-w-full h-max flex flex-col gap-6 lg:gap-12 lg:max-w-2xl">
      <span class="text-[#292d32] font-normal text-3xl md:text-4xl lg:text-6xl">Your Profile</span>
      <div class="w-max max-w-full h-max flex flex-col gap-6 lg:gap-12 lg:pl-11">
        <div class="w-full h-max flex flex-col items-start justify-start gap-8 mx-auto">
          <div class="w-max h-max flex items-center justify-center gap-4">
            <span class="text-2xl md:text-3xl">Account Status:</span>
            <div data-status="{{ $profile->status }}" class="w-max flex items-center justify-center border-[1px] border-black rounded-full px-4 py-1.5 bg-amber-200 data-[status='rejected']:bg-red-400 data-[status='approved']:bg-[#B5DCAE] data-[status='pending']:bg-[#D7DC9C]">
              <span class="text-black font-inter text-[8px] lg:text-xs font-semibold" v-text="{rejected: 'Rejected', approved: 'Approved', pending: 'Pending', 'not_sent' : 'Not Completed'}[@js($profile->status)]"></span>
            </div>
          </div>
          <div class="w-full flex flex-col gap-2 mb-2 font-medium text-xl md:text-2xl lg:text-4xl text-[#292D32]">
            <span>{{ $profile->first_name }} {{ $profile->last_name }}.</span>
            <span>{{ $profile->role }}, {{ $profile->company }}</span>
            <span>{{ $profile->location }}</span>
          </div>
          <iframe class="w-full h-[140px] lg:hidden" src="https://maps.google.com/maps?key={{ config('google.key') }}&q={{ $profile->latitude }},{{ $profile->longitude }}&hl=es&z=14&amp;output=embed"></iframe>
        </div>
        <div class="w-full h-max flex flex-col gap-2 font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">
          <span>Type of accommodation: {{ ucfirst($profile->accommodation_type ?? '-') }}</span>
          <span>Number of bedrooms: {{ $profile->sleep_rooms ?? '-' }}</span>
          <span>Number of people: {{ $profile->bedrooms ?? '-' }}</span>
          <x-splade-data default="{show: false}">
            <div class="w-full flex flex-row items-start justify-start gap-2">
              <span>Amenties: </span>
              <div v-if="data.show" class="w-full flex flex-row flex-wrap gap-2">
                @foreach ($profile->features as $key => $feature)
                <span>{{ $feature }}{{ $key + 1 === count($profile->features) ? '' : ' - ' }}</span>
                @endforeach
              </div>
              <span v-else @click="data.show = true" class="underline cursor-pointer">Show</span>
            </div>
          </x-splade-data>

        </div>
        <div class="w-full h-max flex flex-col gap-2 font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">
          <span>Telephone Number: {{ $profile->telephone ?? '-' }}</span>
          <span>LinkedIn URL: <a class="underline text-lg md:text-xl lg:text-2xl" href="{{ $profile->linkedin }}" target="_blank">Open</a></span>
          <span>Email: {{ auth()->user()->email }}</span>
          <span>Password: ********</span>
        </div>
      </div>
    </div>
    <div class="w-full max-w-[523px] h-max flex flex-col items-center justify-between gap-16 lg:ml-[15rem]">
      <div class="w-full h-max flex flex-col items-center justify-center gap-2 lg:g-[166px]">
        <span class="font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">Referral's Tracker</span>
        <div class="w-full h-[83px] lg:h-[166px] flex items-center justify-center border-[1px] border-black">
          <span class="font-light text-6xl lg:text-[140px] text-[#292D32]">{{ $refs_count }}</span>
        </div>
      </div>
      <iframe class="w-full h-[323px] max-w-[523px] hidden lg:block" src="https://maps.google.com/maps?key={{ config('google.key') }}&q={{ $profile->latitude }},{{ $profile->longitude }}&hl=es&z=14&amp;output=embed"></iframe>
    </div>
  </div>
</section>
<div class="w-full h-max flex items-center justify-center pb-10 lg:pb-20">
  <Link href="{{ route('referral_code') }}">
  <x-button>Refer your friends now</x-button>
  </Link>
</div>
<x-footer />
