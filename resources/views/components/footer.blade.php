<footer class="w-full h-max flex flex-col gap-4 items-center justify-center bg-[#D29A9A80] text-[#717171] py-20">
  <figure>
    <img src="{{asset('images/logo.png')}}" alt="Logo"/>
  </figure>
  <p>Privacy Policy | T&C | The Dream Office Campaing | Swap Guidelines</p>
  <div class="w-full flex flex-row items-center justify-center gap-5 md:gap-10 flex-wrap mt-2">
    <Link href="#">
      <x-feathericon-instagram class="w-6 h-6"/>
    </Link>
    <Link href="#">
      <x-feathericon-twitter class="w-6 h-6"/>
    </Link>
    <Link href="#">
      <x-fab-tumblr class="w-6 h-6" />
    </Link>
  </div>
  <Link href="{{route('home')}}">{{str_replace(['http://', 'https://'], 'www.', env('APP_URL'))}}</Link>
</footer>
