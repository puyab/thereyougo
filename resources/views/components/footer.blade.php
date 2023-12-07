<footer
    class="w-full h-max flex flex-col gap-4 items-center justify-center bg-[#D29A9A80] text-[#717171] py-20 px-4 lg:px-0 text-center">
    <figure>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
    </figure>
    <p>
        <Link href="{{ route('privacy') }}">Privacy Policy</Link>
        |
        <Link href="{{ route('terms') }}"> T&C</Link>
        |
        <Link href="{{ route('dream-contest') }}"> The Dream Office</Link>
    </p>
    <div class="w-full flex flex-row items-center justify-center gap-5 md:gap-10 flex-wrap mt-2">
        <a href="https://instagram.com/thereyougo.eu?igshid=MzRlODBiNWFlZA==" target="_blank">
            <x-feathericon-instagram class="w-6 h-6" />
        </a>
        <a href="https://www.linkedin.com/company/thereyougoeurope/" target="_blank">
            <x-feathericon-linkedin class="w-6 h-6" />
        </a>
        <Link href="#">
        <x-fab-tumblr class="w-6 h-6" />
        </Link>
    </div>
    <Link href="{{ route('home') }}">{{ str_replace(['http://', 'https://'], 'www.', env('APP_URL')) }}</Link>
</footer>
