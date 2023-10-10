@props(['type' => 'register'])

<div data-page="{{$type}}" class="w-full h-max min-h-screen data-[page='login']:bg-[#DEEBEC] bg-[#d29a9a80] flex flex-col">
    <div class="w-full h-max flex items-center justify-end p-10 lg:p-20">
        <Link href="{{route('home')}}">
            <x-feathericon-x class="w-8 h-8" />
        </Link>
    </div>
    <div class="w-full h-max flex flex-col gap-20 lg:gap-40 items-center">
        <span class="text-[#292D32] text-4xl lg:text-6xl font-normal">Insert your details here</span>
        <div class="w-full h-max max-w-[451px] px-3 sm:px-0">
            {{$slot}}
        </div>
    </div>
</div>
