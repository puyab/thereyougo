{{-- <x-guest-layout> --}}
{{--    <x-auth-card> --}}
{{--        <!-- Session Status --> --}}
{{--        <x-auth-session-status class="mb-4" /> --}}

{{--
{{--    </x-auth-card> --}}
{{-- </x-guest-layout> --}}

<x-layouts.auth type="login">
    <x-splade-form action="{{ route('login') }}" class="w-full h-max flex flex-col gap-4 items-center">
        <x-input id="email" type="email" name="email" v-model="form.email" placeholder="Email" required autofocus />
        <x-input id="password" type="password" name="password" v-model="form.password" placeholder="Password" required
            autocomplete="current-password" />
        <div class="mt-16 lg:mt-36 flex flex-row items-center justify-center gap-6">
            <x-button>
                Continue
            </x-button>
            <Link class="text-2xl font-medium underline" href="{{ route('reset-password') }}">Reset Password</Link>
        </div>

    </x-splade-form>
</x-layouts.auth>
