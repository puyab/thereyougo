<x-layouts.auth type="login">
    <x-splade-form action="{{ route('login') }}" class="w-full h-max flex flex-col gap-4 items-center">
        <x-input id="email" type="email" name="email" v-model="form.email" placeholder="Email" required autofocus />
        <x-input id="password" type="password" name="password" v-model="form.password" placeholder="Password" required
            autocomplete="current-password" />
        <div class="w-full h-10 flex items-center justify-start pl-3">
            <Link class="text-lg font-inter font-medium underline mt-2 lg:mt-4" href="{{ route('reset-password') }}">
            Reset Password</Link>
        </div>
        <x-button class="mt-16 lg:mt-32">
            Continue
        </x-button>
    </x-splade-form>
</x-layouts.auth>
