@props(['title' => '', 'defaultOpen' => false])
<x-splade-data :default="['open' => $defaultOpen]">
    <div class="w-full pb-11 h-max flex items-center justify-between border-b-[0.72px] border-b-black cursor-pointer"
        @click="data.open = !data.open">
        <span class="font-light text-3xl md:text-4xl lg:text-5xl 2xl:text-6xl">{{ $title }}</span>
        <x-feathericon-minus class="w-8 h-8 text-[#EC5E59]" v-if="data.open"></x-feathericon-minus>
        <x-feathericon-plus class="w-8 h-8 text-[#EC5E59]" v-else></x-feathericon-plus>
    </div>
    <div class="w-full h-max" v-show="data.open">
        {{ $slot }}
    </div>
</x-splade-data>
