@props(['options' => '[]'])

<x-splade-data
  default="{name: '{{$attributes->get('name')}}', type: '{{$attributes->get('type')}}', open: false, options: {{$options}}}">
  <div class="w-full h-max flex flex-col gap-2"
       v-click-outside="() => data.open ? data.open = false : undefined"
  >
    <div
      v-if="data.type === 'select'"
      class='relative w-full bg-transparent box'
    >
      <div
        class="w-full bg-transparent border-0 border-b-[1px] border-b-black text-3xl font-light py-3 flex items-center justify-between cursor-pointer"
        @click="data.open=!data.open"
      >
        <div class="pl-2.5">
          <span v-if="form[data.name] === null">{{$attributes->get('placeholder')}}</span>
          <span v-else v-text="data.options.filter((option) => option[0] === form[data.name])[0][1]"></span>
        </div>
        <div :class="{'rotate-180': data.open}">
          <x-feathericon-chevron-up />
        </div>
      </div>
      <div v-show="data.open"
           class="w-full h-max text-3xl font-light absolute z-30 top-[100%] left-0 bg-white border-[1px] border-black rounded-md flex flex-col items-center justify-center gap-2">
        <div v-for="option in data.options" @click="form[data.name] = option[0]; data.open = false;"
             class="w-full h-max py-2 hover:bg-gray-100 transition-colors duration-300">
          <span v-text="option[1]"></span>
        </div>
      </div>
    </div>
    <input
      class='w-full bg-transparent border-0 border-b-[1px] border-b-black placeholder:text-black text-3xl font-light'
      style="outline: none"
      {{$attributes}}
      v-else
    />
    <span class="text-red-500 font-semibold text-lg" v-if="form.errors[data.name]"
          v-text="form.errors[data.name]"></span>
  </div>
</x-splade-data>
