@php
    use App\Models\Profile;
    $raw_profiles = cache()->remember('home_profiles', now()->addMinute(), function () {
        return Profile::query()
            ->select(['id', 'first_name', 'last_name', 'company', 'role'])
            ->with('media')
            ->get();
    });
    $profiles = $raw_profiles->chunk(count($raw_profiles) / 2);
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

    <!-- mobile -->
    <h1 class="block md:hidden">The Home Exchange <br> for LinkedIn Professionals </h1>
     <!-- desktop -->
    <h1 class="hidden md:block"><div>The Home Exchange</div> <br><div> for LinkedIn Professionals</div> </h1>

    <!-- desktop -->
    <p class="after-title hidden md:block">Swap your house, apartment or room and travel the world for $0/night</p>
    <!-- mobile -->
    <p class="after-title block md:hidden">You’ve dreamt about it. We’ve made it possible</p>

    <div class="link">
        <x-home.watch />
    </div>

    <!-- desktop -->
    <p class="after hidden md:block">You’ve dreamt about it. We’ve made it possible</p>
    <!-- mobile -->
    <p class="after block md:hidden">Swap your house, apartment or room and travel the world for $0/night</p>

</div>

<section class="w-full h-max">
  <div id="logos">
        <h3>Join your peers</h3>
        <section class="">
            <div class="d-flex justify-content-between">
                <div class="ite">
                    <img src="images/logo1.png" alt="">
                </div>
                <div class="ite">
                    <img src="images/logo2.png" alt="">
                </div>
                <div class="ite">
                    <img src="images/logo3.png" alt="">
                </div>
                <div class="ite">
                    <img src="images/logo4.png" alt="">
                </div>
                <div class="ite">
                    <img src="images/logo5.png" alt="">
                </div>
            </div>
        </section>
    </div>
</section>


<section class="w-full flex flex-col gap-8 relative">
    <x-home.users-slider :profiles="$profiles[0]" />
    <x-home.users-slider :profiles="$profiles[1]" />
</section>

<section class="pb-4 pt-8 md:py-16 px-10 md:px-20 lg:px-24 text-center ">
    <Link href="{{ route('register') }}">

    <p class="text-[#292D32] block md:hidden">Worldwide, owners and renters welcome.</p>
    <br>
    <div class="buttons">
        <x-button class="lg:text-base max-h-[50px]">Apply now</x-button>
    </div>
    </Link>
    <br>
    <p class="font-light text-2xl text-[#292D32] hidden md:block">Worldwide, owners and renters welcome.</p>

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
            <div class="link">
                <x-home.win class="lg:text-base max-h-[50px]" />
            </div>
            <Link href="{{ route('register') }}">
                <x-button class="lg:text-base max-h-[50px]">Apply now</x-button>
            </Link>
        </div>

</section>

<section id="stepsa" class="w-full h-max px-6 lg:px-20 py-[45px] lg:py-[90px] flex flex-col gap-[81px] ">
        <div class="win">
            <h3 class="font-light text-3xl sm:text-3xl md:text-4xl lg:text-6xl">Three steps to get started</h3>
        </div>
        <div
            class="w-full h-max grid grid-cols-1 md:grid-cols-2 lg:flex lg:flex-row lg:items-center lg:justify-between place-items-center place-content-center gap-y-4">
            @foreach ($work_steps as $key => $step)
                <div class="w-full flex items-start justify-center gap-7 max-w-[550px]">
                    <span class="font-medium text-2xl md:text-3xl lg:text-5xl text-black">{{ $key + 1 }}</span>
                    <div class="w-full h-max flex flex-col items-start justify-start gap-5 {{ $key == 0 ? 'first-div-padd' : '' }}">
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

<div id="faqtop">
        <h3>Frequently Asked Questions</h3>
        <p>Check out what your peers are asking us. If you have more questions contact us at . <a
                href="#">info@thereyougo.eu</a></p>
</div>
<div id="faqs" class="w-11/12 max-w-6xl mx-auto my-[56px] lg:my-[112px] flex flex-col gap-14">
    @foreach ($faqs as $faq)
        <x-accordion title="{{ $faq['title'] }}">
            <p class="w-full h-max text-left sm:text-xs md:text-xl lg:text-2xl font-normal">
                {{ $faq['content'] }}
            </p>
        </x-accordion>
    @endforeach
</div>
<x-footer />
