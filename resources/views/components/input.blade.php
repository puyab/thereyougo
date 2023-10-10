<x-splade-data default="{name: '{{$attributes->get('name')}}'}">
    <div class="w-full h-max flex flex-col gap-2">
        <input class='w-full bg-transparent focus:outline-none border-0 border-b-[1px] text-3xl font-light'
            {{$attributes}}
        />
        <span class="text-red-500 font-semibold text-lg" v-if="form.errors[data.name]"
              v-text="form.errors[data.name]"></span>
    </div>
</x-splade-data>
