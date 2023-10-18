<x-splade-data default="{link: '{{route('register') . '?referred=' . auth()->user()->profile->referral_code}}'}">
  <x-splade-form action="{{route('referral_code.notify')}}" method="POST">
    <div class="w-full h-max min-h-screen bg-[#d29a9a80] flex flex-col">
      <div class="w-full h-max flex items-center justify-end p-10 lg:p-20">
        <x-link href="{{route('profile.global')}}">
          <x-feathericon-x class="w-8 h-8"/>
        </x-link>
      </div>
      <div class="w-full h-max flex flex-col gap-2.5 lg:gap-5 items-center px-4 lg:px-0">
      <span
        class="text-[#292D32] text-4xl lg:text-6xl font-normal">Win the Dream Office by referring your friends.</span>
        <div class="w-full max-w-max flex flex-col items-center justify-center gap-8">
          <span class="font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">Copy the following link and send via Whatsapp or LinkedIn.</span>
          <span class="font-light text-xl md:text-2xl lg:text-3xl text-[#292D32]">Use the tracker to check how many registers.</span>
          <div
            class="w-full max-w-max flex flex-wrap items-center justify-center rounded-lg border-[1px] border-black gap-6 px-6 py-3 mt-4">
            <span class="w-full max-w-max font-light text-xl md:text-2xl lg:text-3xl break-words"
                  v-text="data.link.replace('http://', 'www.').replace('https://', 'www.')"></span>
            <button>
              <x-feathericon-copy class="text-black w-11 h-11 cursor-pointer"
                                  @click="window.navigator.clipboard.writeText(data.link)"/>
            </button>
          </div>
          <x-button class="mt-10" @click="window.navigator.clipboard.writeText(data.link)">Copy link</x-button>
        </div>
      </div>
    </div>
  </x-splade-form>
</x-splade-data>
