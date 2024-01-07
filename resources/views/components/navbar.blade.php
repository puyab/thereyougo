<div id="top-nav">
    <div id="logo">
        <Link href="{{ route('home') }}">
        <img src="images/logo_m.png" alt="Logo">
        </Link>
    </div>
    <nav>
        <div class="w-max h-max flex items-center justify-center gap-7 lg:gap-14">
            @if (auth()->check())
                <x-link class="font-bold text-xs sm:text-base text-black font-inter"
                    href="{{ route('logout') }}">Log-out</x-link>
                <Link href="{{ route('profile') }}" class="font-bold text-xs sm:text-base text-black font-inter">Settings
                </Link>
                <Link href="{{ auth()->user()->profile->canAccessProfile()? route('profile.global'): '#' }}">
                <x-feathericon-user class="w-8 h-8 lg:w-12 lg:h-12 text-white bg-black rounded-full p-2" />
                </Link>
            @else
                <a href="#faqsnaser" class="font-bold text-xs sm:text-base text-black hidden md:block font-inter">FAQs</a>
                <x-link :href="route('login')" class="font-bold text-xs sm:text-base text-black font-inter">Login</x-link>
                <x-link :href="route('register')">
                    <x-button>Apply
                        now
                    </x-button>
                </x-link>
            @endif
        </div>
    </nav>
</div>


{{--  <nav class="w-full h-max bg-[#D29A9A80] flex items-center justify-between px-6 py-4 lg:py-9 lg:px-20">
  <Link href="{{ route('home') }}">
  <figure>
      <img src="{{ asset('images/logo.png') }}" alt="Logo"
          class="w-11 lg:w-full max-w-[86.73px] aspect-auto opacity-50" />
  </figure>
  </Link>
  <div class="w-max h-max flex items-center justify-center gap-7 lg:gap-14">
      @if (auth()->check())
          <x-link class="font-bold text-xs sm:text-base text-black font-inter"
              href="{{ route('logout') }}">Log-out</x-link>
          <Link href="{{ route('profile') }}" class="font-bold text-xs sm:text-base text-black font-inter">Settings
          </Link>
          <Link href="{{ auth()->user()->profile->canAccessProfile()? route('profile.global'): '#' }}">
          <x-feathericon-user class="w-8 h-8 lg:w-12 lg:h-12 text-white bg-black rounded-full p-2" />
          </Link>
      @else
          <a href="#faqs" class="font-bold text-xs sm:text-base text-black hidden md:block font-inter">FAQs</a>
          <x-link :href="route('login')" class="font-bold text-xs sm:text-base text-black font-inter">Login</x-link>
          <x-link :href="route('register')">
              <x-button>Apply
                  now
              </x-button>
          </x-link>
      @endif
  </div>
</nav>  --}}
