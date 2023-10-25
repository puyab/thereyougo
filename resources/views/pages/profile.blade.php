@php
  $profile = auth()->user()->profile;
  $images = [];
  foreach(['avatar', 'pic_1', 'pic_2', 'pic_3'] as $collection) {
      $images[$collection] = $profile->getFirstMediaUrl($collection);
  }
  $refs_count = \App\Models\Profile::query()->where('referred_from', $profile->referral_code)->count();
@endphp

<x-navbar/>
<section
  class="w-full h-max bg-[#D29A9A80] flex flex-col-reverse lg:flex-row items-center justify-center lg:gap-20 gap-5 px-7 lg:px-14 py-[52.5px] lg:py-[105px]">
  <div class="w-full h-max flex flex-col items-start justify-start gap-8 max-w-[600px]">
    <h2 class="font-normal text-2xl sm:text-3xl md:text-4xl lg:text-6xl text-[#292D32]">Start referring your friends to
      win the dream office.</h2>
    <Link href="{{route('referral_code')}}">
    <x-button>Refer your friends now</x-button>
    </Link>
  </div>
  <figure class="w-full max-w-[587px]">
    <img class="w-full aspect-auto" src="{{asset('images/profile_cover.png')}}"/>
  </figure>
</section>
<section
  class="w-max max-w-full h-max mx-auto px-7 lg:px-14 py-[41px] lg:py-[82px] flex flex-col items-start justify-start">
  <div
    class="relative w-max max-w-full mx-auto h-max lg:h-[425px] lg:mt-[82px] lg:max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-4 place-items-center place-content-center data-[safari=true]:h-[1100px]  data-[safari=true]:lg:h-max"
    :data-safari="window.navigator.userAgent.indexOf('Safari') !== -1">
    <figure class="w-full h-full min-w-[364px] min-h-[202px]">
      <img class="w-full h-full object-fill" src="{{$images['pic_1'] === '' ? asset('images/not-found.jpg') : $images['pic_1']}}"/>
    </figure>
    <div class="w-full h-max grid grid-cols-1 gap-5 place-content-center place-items-center">
      <figure class="w-full min-w-[364px] h-[202px] max-h-[202px]">
        <img class="w-full h-full object-fill" src="{{$images['pic_2'] === '' ? asset('images/not-found.jpg') : $images['pic_2']}}"/>
      </figure>
      <figure class="w-full min-w-[364px] h-[202px] max-h-[202px]">
        <img class="w-full h-full object-fill" src="{{$images['pic_3'] === '' ? asset('images/not-found.jpg') : $images['pic_3']}}"/>
      </figure>
    </div>
    <div
      class="w-full h-[202px] flex items-center justify-center lg:rounded-full lg:overflow-hidden lg:w-[275px] lg:h-[265px] lg:border-[3px] lg:border-white lg:absolute z-20 left-0 top-[50%]">
      <figure
        class="w-full h-full min-w-[364px] min-h-[202px] lg:min-w-[unset] lg:min-h-[unset] lg:w-[150%] lg:h-[120%]">
        <img class="w-full h-full object-fill" src="{{$images['avatar'] === '' ? asset('images/not-found.jpg') : $images['avatar']}}"/>
      </figure>
    </div>
    <div class="w-full flex flex-col gap-2 mb-2 lg:mb-0 lg:ml-[38rem] font-light text-xl md:text-2xl lg:text-4xl text-[#292D32]">
      <span>{{$profile->first_name}} {{$profile->last_name}}.</span>
      <span>{{$profile->role}}, {{$profile->company}}</span>
      <span>{{$profile->location}}</span>
      <div data-status="{{$profile->status}}"
           class="w-max flex items-center justify-center border-[1px] border-black rounded-full px-3.5 py-1.5 bg-amber-200 data-[status='rejected']:bg-red-400 data-[status='approved']:bg-[#B5DCAE] data-[status='pending']:bg-[#D7DC9C]">
        <span class="text-black font-inter text-xs font-semibold"
              v-text="{rejected: 'Rejected', approved: 'Approved', pending: 'Pending', 'not_sent' : 'Not Completed'}[@js($profile->status)]"></span>
      </div>
    </div>
  </div>
  <div class="lg:mt-[11rem] w-full flex flex-col gap-4 lg:flex-row lg:gap-8 lg:items-center lg:justify-between">
    <div class="w-max max-w-full h-max flex flex-col gap-6 lg:max-w-2xl">
      <div class="w-full h-max flex flex-col gap-4 font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">
        <span>Type of accommodation: {{ucfirst($profile->accommodation_type ?? '-')}}</span>
        <span>Number of bedrooms: {{$profile->sleep_rooms ?? '-'}}</span>
        <span>Number of people: {{$profile->bedrooms ?? '-'}}</span>
        <x-splade-data default="{show: false}">
          <div class="w-full flex flex-row items-start justify-start gap-2">
            <span>Amenties: </span>
            <div v-if="data.show" class="w-full flex flex-row flex-wrap gap-2">
              @foreach($profile->features as $key => $feature)
                <span>{{$feature}}{{$key + 1 === count($profile->features) ? '' : ' - '}}</span>
              @endforeach
            </div>
            <span v-else @click="data.show = true" class="underline cursor-pointer">Show</span>
          </div>
        </x-splade-data>

      </div>
      <div class="w-full h-max flex flex-col gap-4 font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">
        <span>Telephone Number: {{$profile->telephone ?? '-'}}</span>
        <span>LinkedIn URL: <a class="underline text-lg md:text-xl lg:text-2xl" href="{{$profile->linkedin}}"
                               target="_blank">Open</a></span>
        <span>Email: {{auth()->user()->email}}</span>
        <span>Password: ********</span>
      </div>
    </div>
    <iframe
      class="w-full h-[380px] max-w-[410px] "
      frameborder="0"
      scrolling="no"
      marginheight="0"
      marginwidth="0"
      src="https://maps.google.com/maps?key={{env('google.key')}}&q={{$profile->latitude}},{{$profile->longitude}}&hl=es&z=14&amp;output=embed"></iframe>
    {{--    <figure class="w-full max-w-[410px]">--}}
    {{--      <img class="w-full aspect-auto" src="{{asset('images/googlemaps.png')}}" alt="Google maps"/>--}}
    {{--    </figure>--}}
  </div>
</section>
<section class="w-full px-7 lg:px-14 py-[102px] lg:py-[204px] bg-[#D0E3E4B2] flex flex-col gap-7 lg:gap-14">
  <h2 class="font-light text-[#292D32] text-2xl sm:text-3xl md:text-4xl lg:text-6xl">The Dream Office Referrals’
    counter</h2>
  <div class="w-full flex flex-col gap-5 lg:flex-row items-center justify-between">
    <div class="w-full flex flex-col gap-6 font-light text-xl md:text-2xl lg:text-3xl">
      <span>The tracker  will help you understand</span>
      <span>how many of your referrals registered.</span>
      <span>The more you refer, the higher the change of winning </span>
      <span>2 weeks stay in an amazing  villa in Italy.</span>
      <span>Don’t miss out.</span>
    </div>
    <div class="w-max h-full flex flex-col gap-4 lg:gap-8 ">
      <div class="w-full h-[113px] md:h-[226px] md:w-[416px] bg-white flex items-center justify-center">
        <span class="font-light text-4xl text-[#292D32] lg:text-9xl">{{$refs_count}}</span>
      </div>
      <Link href="{{route('referral_code')}}">
      <x-button>Refer your friends now</x-button>
      </Link>
    </div>
  </div>
</section>
<section class="w-full px-7 lg:px-14 py-[102px] lg:py-[204px] flex flex-col gap-6 lg:gap-11">
  <h2 class="font-light text-[#292D32] text-2xl sm:text-3xl md:text-4xl lg:text-6xl">What happens now?</h2>
  <div class="w-full h-max flex flex-col gap-6 font-light text-xl md:text-2xl lg:text-3xl">
    <span>1- Wait for your profile to be verified and approved</span>
    <span>2- Keep referring your friends and peers to increase the chances of winning the Dream Office</span>
    <span>3- Be ready to start travelling for $0/night once the platform opens for swaps!</span>
  </div>
</section>
<x-footer/>
