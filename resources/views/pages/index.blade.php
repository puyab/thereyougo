@php
  use App\Models\Profile;
  $count = Profile::query()->count() / 2;
  $profiles = [
      Profile::query()->with('media')->where('id', '<=', $count)->get(),
      Profile::query()->with('media')->where('id', '>', $count)->get(),
  ];
  $work_steps = [
    [
        'title' => 'Apply for membership',
        'description' => 'Made by LinkedIn Professionals for LinkedIn Professionals, every profile needs to go through our verification process.'
    ],
    [
        'title' => 'Refer your friends',
        'description' => 'While you wait, refer as many firiends as you can and you’ll get the chance to win a 2 weeks stay in the hearth of Italy for you and your friends.'
    ],
    [
        'title' => 'Start travelling',
        'description' => 'Once your profile is verified and we open the exchanges, you’ll be able to start swapping and travel for $0/night around the world!'
    ],
];
@endphp

<x-navbar/>
<section class="w-full h-max bg-[#D29A9A80] px-12 py-4 lg:py-9 lg:px-24 lg:pb-20 lg:pt-12 flex flex-col gap-16">
  <h2 class="font-normal text-xl sm:text-2xl md:text-4xl lg:text-6xl">The Home Exchange for LinkedIn Professionals.<br/>
    Swap your house, apartment or room and travel the world for $0/night.</h2>
  <img class="w-full aspect-auto" src="{{asset('images/youtube.png')}}"/>
  <p class="font-light text-sm sm:text-base text-center md:text-lg lg:text-3xl">You’ve dreamt about it. We’ve made it
    possible.</p>
</section>
<section class="py-16 px-12 lg:px-24 flex flex-col gap-4 lg:flex-row items-center justify-between">
  <h2 class="font-normal text-3xl lg:text-6xl text-[#292D32]">Join your peers</h2>
  <Link href="{{route('register')}}">
  <x-button>Apply now</x-button>
  </Link>
  <p class="font-light text-2xl text-[#292D32]">Worldwide, owners and renters welcome.</p>
</section>
<section class="w-full flex flex-col gap-8 relative">
  <x-home.users-slider :profiles="$profiles[0]"/>
  <x-home.users-slider :profiles="$profiles[1]"/>
</section>
<section
  class="w-full bg-[#DEEBEC] mt-[57.5px] lg:mt-[115px] px-7 lg:px-14 py-[52.5px] lg:py-[105px] flex flex-col lg:flex-row-reverse items-center justify-center gap-10 lg:gap-8"
  id="dream">
  <figure class="w-full max-w-[800px] aspect-auto">
    <img src="{{asset('images/dream.png')}}"/>
  </figure>
  <div class="w-full h-max flex flex-col gap-16">
    <h2 class="font-light text-2xl sm:text-3xl md:text-4xl lg:text-6xl text-[#292D32]">The Dream Office</h2>
    <div class="font-normal text-sm sm:text-base lg:text-lg max-w-[500px] flex flex-col gap-4 lg:gap-8">
      <span>Stand a chance of winning a 2-weeks stay at this
Villa in the middle of Italy, for 5 people.</span>
      <span>Apply before January 31st 2024.</span>
      <span>Refer your peers and friends.</span>
      <span>Don’t miss out.</span>
    </div>
    <Link href="{{route('register')}}">
    <x-button>Apply now</x-button>
    </Link>
  </div>
</section>
<section class="w-full h-max px-7 lg:px-14 py-[102px] lg:py-[204px] flex flex-col gap-[81px] lg:gap-[162px]">
  <h2 class="font-light text-3xl sm:text-3xl md:text-4xl lg:text-6xl">How does it work</h2>
  <div
    class="w-full h-max grid grid-cols-1 md:grid-cols-2 lg:flex lg:flex-row lg:items-center lg:justify-between place-items-center place-content-center gap-y-4">
    @foreach($work_steps as $key => $step)
      <div class="w-full flex items-start justify-center gap-7 lg:gap-14 max-w-[500px]">
        <span class="font-medium text-2xl md:text-3xl lg:text-5xl text-black">{{$key+1}}</span>
        <div class="w-full h-max flex flex-col items-start justify-start gap-5">
          <h3 class="font-medium text-2xl md:text-3xl lg:text-[38px]">{{$step['title']}}</h3>
          <p
            class="w-full font-normal text-lg md:text-base lg:text-[19px] text-[#383838] leading-[28.8px] text-left">{{$step['description']}}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>
<x-footer/>
