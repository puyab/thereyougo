<x-layouts.auth acrtion="{{ route('reset-password.handle', $id) }}" type="reset-password"
    default="{password: '', password_confirmation: ''}">
    <x-splade-form class="w-full h-max flex flex-col items-center justify-center gap-10">
        <x-input type="password" id="password" name="password" v-model="form.password" placeholder="Password" required
            autofocus />
        <x-input type="password_confirmation" id="password_confirmation" name="password_confirmation"
            v-model="form.password_confirmation" placeholder="Password confirmation" required autofocus />
        <x-button>Continue</x-button>
    </x-splade-form>
</x-layouts.auth>
