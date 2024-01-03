@php
    use App\Models\Profile;
    $raw_profiles = cache()->remember('home_profiles', now()->addMinute(), function () {
        return Profile::query()
            ->select(['id', 'first_name', 'last_name', 'company', 'role'])
            ->with('media')
            ->get();
    });
    $profiles = $raw_profiles->chunk(10 / 2);
    $work_steps = [
        [
            'title' => 'Apply for membership',
            'description' => 'Made by LinkedIn Professionals for LinkedIn Professionals, every profile needs to go through our verification process.',
        ],
        [
            'title' => 'Refer your friends',
            'description' => 'While you wait, refer as many firiends as you can and you’ll get the chance to win a 2 weeks stay in the hearth of Italy for you and your friends.',
        ],
        [
            'title' => 'Start travelling',
            'description' => 'Once your profile is verified and we open the exchanges, you’ll be able to start swapping and travel for $0/night around the world!',
        ],
    ];

    $faqs = config('faqs');
@endphp
<div id="slide">
  <x-navbar />

	<h1>The Home Exchange for LinkedIn Professionals </h1>
	<p class="after-title">Swap your house, apartment or room and travel the world for $0/night</p>

	<div class="link">
        <x-home.watch />
	</div>


	<p class="after">You’ve dreamt about it. We’ve made it possible</p>

</div>
<div id="logos">
	<h3>Join your peers</h3>
  <section class="w-full flex flex-col gap-8 relative mt-3">
    <x-home.peers-slider />
</section>
</div>
{{--  <section
    class="w-full h-max bg-[#D29A9A80] px-4 pt-4 pb-8 lg:py-9 lg:px-20 lg:pb-20 lg:pt-12 flex flex-col gap-8 lg:gap-16">
    <h2 class="font-medium text-3xl sm:text-4xl md:text-5xl lg:text-6xl">The Home Exchange for LinkedIn
        Professionals.<br />
        <span class="font-normal text-xl text-left md:text-2xl lg:text-3xl lg:hidden mt-4">You’ve dreamt about it. <br />
            We’ve made it
            possible.</span>
        <span class="font-normal text-xl text-left md:text-2xl lg:text-3xl hidden lg:block mt-4">
            Swap your house, apartment or room and travel the world for $0/night.</span>
    </h2>
    <x-splade-data default="{open: false}">
        <div @click="data.open = true" class="relative w-full h-max">
            <img class="w-full min-h-[177px] aspect-auto md:hidden" style="border: 1px solid black"
                src="{{ asset('images/youtube.jpeg') }}" alt="" />
            <img class="w-full min-h-[177px] hidden md:block " src="{{ asset('images/youtube.png') }}" alt="" />
            <div class="absolute w-full h-full inset-0 flex items-center justify-center cursor-pointer">
                <div
                    class="w-max h-max flex items-center justify-center bg-white rounded-[4999px] border-[1px] border-black py-1.5 px-3.5 md:py-3 md:px-7">
                    <span class="text-black text-[8px] sm:text-sm font-inter lg:text-base font-semibold">Watch the
                        video</span>
                </div>
            </div>
        </div>
        <div v-if="data.open" class="fixed inset-0 bg-black/30 z-50 flex items-center justify-center">
            <iframe class="w-11/12 h-5/6 border-none outline-none rounded-xl z-10"
                src="https://www.youtube.com/embed/TE_IvgXkYEs?si=Yl0Z17swjs3jvLEU&amp;controls=0"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
            <div class="absolute inset-0 bg-transparent z-0" @click="data.open = false"></div>
        </div>
    </x-splade-data>
    <span class="font-normal text-xl text-left md:text-2xl lg:text-5xl hidden lg:block mx-auto">You’ve dreamt
        about it.
        We’ve made it
        possible.</span>
    <span class="font-normal text-center text-xl md:text-2xl lg:text-3xl lg:hidden mx-auto">
        Swap your house, apartment or room and travel the world for $0/night.</span>
</section>  --}}
{{--  <section class="pb-4 pt-8 md:py-16 px-10 md:px-20 lg:px-24 flex gap-4 flex-row items-center justify-between">
    <h2 class="font-normal text-3xl lg:text-6xl text-[#292D32]">Join your peers</h2>
    <Link href="{{ route('register') }}">
    <x-button class="lg:text-base max-h-[50px]">Apply now</x-button>
    </Link>
    <p class="font-light text-2xl text-[#292D32] hidden md:block">Worldwide, owners and renters welcome.</p>
</section>  --}}
<section class="w-full flex flex-col gap-8 relative mt-3">
    {{-- <x-home.users-slider :profiles="$profiles[0]" />
    <x-home.users-slider :profiles="$profiles[1]" /> --}}
    
</section>

<section class="pb-4 pt-8 md:py-16 px-10 md:px-20 lg:px-24 text-center ">
  <Link href="{{ route('register') }}">

    <div class="buttons">
      <x-button class="lg:text-base max-h-[50px]">Apply now</x-button>

    </div>
    <br>
    <p class="font-light text-2xl text-[#292D32] hidden md:block">Worldwide, owners and renters welcome.</p>

  </Link>
</section>

<section>
  <div id="win" class="win">
    <h3>WIN The Dream Office</h3>
    <p>
      Apply before March 31st.<br>

      Refer your peers and friends.<br>

      Stand a chance of winning a 1-week stay<br>

      at this villa in the middle of Italy, for 4 people.



    </p>
    <p class="after">
      Don’t miss out.
    </p>
    <div class="buttons">
      {{--  <a href="#" class="watch">Watch the video</a>  --}}
      <div class="link">
        <x-home.watch />
	</div>
      <Link href="{{ route('register') }}">
        <x-button>Apply now</x-button>
        </Link>
    </div>
  </div>
</section>
{{--  <section
    class="w-full bg-[#DEEBEC] mt-8 lg:mt-[115px] px-6 lg:px-20 py-10 lg:py-20 flex flex-col lg:flex-row-reverse items-center justify-center gap-10 lg:gap-8"
    id="dream">
    <h2 class="font-normal text-3xl md:text-4xl text-[#292D32] lg:hidden self-start">The Dream Office</h2>
    <x-splade-data default="{open: false}">
        <div @click="data.open = true" class="relative w-full max-w-[800px]">
            <figure class="w-full h-max">
                <img class="w-full min-h-[250px] lg:min-h-none aspect-auto" src="{{ asset('images/dream.png') }}" />
            </figure>
            <div class="absolute w-full h-full inset-0 flex items-center justify-center cursor-pointer">
                <div
                    class="w-max h-max flex items-center justify-center bg-white rounded-[4999px] border-[1px] border-black py-1.5 px-3.5 md:py-3 md:px-7">
                    <span class="text-black text-[8px] font-inter sm:text-sm lg:text-base font-semibold">Watch the
                        video</span>
                </div>
            </div>
        </div>
        <div v-if="data.open" class="fixed inset-0 bg-black/30 z-50 flex items-center justify-center">
            <iframe class="w-11/12 h-5/6 border-none outline-none rounded-xl z-10"
                src="https://www.youtube.com/embed/1wLEL4w7Zuc?si=0hnMcOOhEoMI_Jmu&amp;controls=0"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
            <div class="absolute inset-0 bg-transparent z-0" @click="data.open = false"></div>
        </div>
    </x-splade-data>
    <div class="w-full h-max flex flex-col gap-16">
        <h2 class="font-normal text-2xl sm:text-3xl md:text-4xl lg:text-6xl text-[#292D32] hidden lg:block">The Dream
            Office</h2>
        <div class="font-normal text-xl lg:text-2xl max-w-[500px] flex flex-col gap-4 lg:gap-8">
            <span>Stand a chance of winning a 2-weeks stay at this
                Villa in the middle of Italy, for 4 people.</span>
            <span>Apply before January 31st 2024.</span>
            <span>Refer your peers and friends.</span>
            <span>Don’t miss out.</span>
        </div>
        <a href="{{ route('terms') }}" class="text-[#4052FB] text-xl font-light underline">Read T&C</a>
        <Link href="{{ route('register') }}">
        <x-button>Apply now</x-button>
        </Link>
    </div>
</section>  --}}
<section id="stepsa" class="w-full h-max px-6 lg:px-20 py-[45px] lg:py-[90px] flex flex-col gap-[81px] ">
   <div class="win">
    <h3 class="font-light text-3xl sm:text-3xl md:text-4xl lg:text-6xl">Three steps to get started</h3>
   </div>
    <div
        class="w-full h-max grid grid-cols-1 md:grid-cols-2 lg:flex lg:flex-row lg:items-center lg:justify-between place-items-center place-content-center gap-y-4">
        @foreach ($work_steps as $key => $step)
            <div class="w-full flex items-start justify-center gap-7 lg:gap-14 max-w-[500px]">
                <span class="font-medium text-2xl md:text-3xl lg:text-5xl text-black">{{ $key + 1 }}</span>
                <div class="w-full h-max flex flex-col items-start justify-start gap-5">
                    <h3 class="font-medium text-2xl md:text-3xl lg:text-[38px]">{{ $step['title'] }}</h3>
                    <p
                        class="w-full font-normal text-lg md:text-base lg:text-[19px] text-[#383838] leading-[28.8px] text-left">
                        {{ $step['description'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</section>
{{--  <section id="faqs"
    class="w-full h-max px-6 lg:px-20 py-10 lg:py-20 bg-[#DEEBEC] flex flex-col items-start justify-start gap-4">
    <h3 class="font-normal text-[#292D32] text-2xl sm:text-3xl md:text-4xl lg:text-6xl">FAQs | Frequently Asked
        Questions</h3>
    <p class="text-xl md:text-2xl lg:text-3xl text-[#292D32] font-medium">Check out what your peers are asking us. If
        you have more questions contact us at <a href="mailto:info@thereyougo.eu"
            class="text-[#0711F4]">info@thereyougo.eu.</a></p>
</section>  --}}

<div id="faqtop">
	<h3>Frequently Asked Questions</h3>
	<p>Check out what your peers are asking us. If you have more questions contact us at . <a href="#">info@thereyougo.eu</a></p>
</div>
<div id="faqsnaser" class="w-11/12 max-w-6xl mx-auto my-[56px] lg:my-[112px] flex flex-col gap-14">
    @foreach ($faqs as $faq)
        <x-accordion title="{{ $faq['title'] }}">
            <p class="w-full h-max text-left text-xl md:text-2xl lg:text-3xl font-normal">
                {{ $faq['content'] }}
            </p>
        </x-accordion>
    @endforeach
</div>
<x-footer />
