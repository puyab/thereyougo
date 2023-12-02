<div
  class="w-full h-[63px] h-full flex flex-col gap-2 max-h-[63px]"
>
  <label>
    <input
      class='w-full bg-transparent h-[63px] border-0 border-b-[1px] border-b-black placeholder:text-black text-3xl font-light outline-none'
      wire:model.live.debounce.500ms="value"
      placeholder="{{$this->placeholder}}"
      type="{{$this->type}}"
      name="{{$this->name}}"
      {{$required ? 'required' : ''}}
    />
  </label>
</div>
