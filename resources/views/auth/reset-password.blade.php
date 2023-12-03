{{-- <x-guest-layout> --}}
{{--    <x-auth-card> --}}
{{--        <!-- Session Status --> --}}
{{--        <x-auth-session-status class="mb-4" /> --}}

{{--
{{--    </x-auth-card> --}}
{{-- </x-guest-layout> --}}

<x-layouts.auth acrtion="{{ route('reset-password.send_mail') }}" type="reset-password" default="{email: ''}">
    <x-splade-form class="w-full h-max flex flex-col items-center justify-center gap-10">
        <x-input type="email" id="email" name="email" v-model="form.email" placeholder="Email" required autofocus />
        <x-button>Continue</x-button>
    </x-splade-form>
</x-layouts.auth>
