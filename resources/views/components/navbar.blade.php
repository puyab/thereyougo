<nav class="w-full h-20 bg-[#D29A9A80] flex items-center justify-between px-12 py-4 lg:py-9 lg:px-24">
  <span class="font-normal text-[#717171] text-lg lg:text-2xl ">Logo to share</span>
  <div class="w-max h-max flex items-center justify-center gap-7 lg:gap-14">
    <x-link class="font-bold text-base text-black">The Dream Office</x-link>
    <x-link :href="route('login')" class="font-bold text-base text-black">Login</x-link>
    <x-link :href="route('register')">
      <x-button class="text-sm md:text-base">Apply now</x-button>
    </x-link>
  </div>
</nav>
