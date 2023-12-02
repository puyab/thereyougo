<form wire:submit.prevent="submit" class="w-full h-max flex flex-col items-center justify-center gap-10">
    <livewire:input wire:model="email" placeholder="Email" type="email" :required="true"/>
    <x-button>Continue</x-button>
</form>
