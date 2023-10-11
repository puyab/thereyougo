@props(['title' => ''])
<x-splade-data default="{open: true}">
    <div class="w-full pb-11 h-max flex items-center justify-between border-b-[0.72px] border-b-black cursor-pointer"
         @click="data.open = !data.open">
        <span class="font-light text-4xl lg:text-6xl">{{$title}}</span>
        <x-feathericon-minus class="w-8 h-8 text-[#EC5E59]" v-if="data.open"/>
        <x-feathericon-plus class="w-8 h-8 text-[#EC5E59]" v-else/>
    </div>
    <div class="w-full h-max" v-show="data.open">
        {{$slot}}
    </div>
</x-splade-data>
