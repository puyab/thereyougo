<nav class="w-full h-20 bg-[#D29A9A80] flex items-center justify-between px-6 py-4 lg:py-9 lg:px-24">
  <Link href="{{route('home')}}"><span class="font-normal text-[#717171] text-base lg:text-xl uppercase font-encode-sans-expanded font-light">ThereYouGo</span></Link>
  <div class="w-max h-max flex items-center justify-center gap-7 lg:gap-14">
    @if(auth()->check())
      <x-link class="font-bold text-base text-black font-inter" href="{{route('logout')}}">Log-out</x-link>
      <Link href="{{route('profile')}}" class="font-bold text-base text-black font-inter">Settings</Link>
      <Link href="{{auth()->user()->profile->canAccessProfile() ? route('profile.global') : '#'}}">
        <x-feathericon-user class="w-12 h-12 text-white bg-black rounded-full p-2"/>
      </Link>
    @else
      <x-link class="font-bold text-xs sm:text-base text-black hidden md:block">The Dream Office</x-link>
      <x-link :href="route('login')" class="font-bold text-xs sm:text-base text-black">Login</x-link>
      <x-link :href="route('register')">
        <x-button class="text-xs md:text-base py-1.5 px-2 md:py-3.5 md:px-7 md:rounded-full w-max rounded-md">Apply now</x-button>
      </x-link>
    @endif
  </div>
</nav>
