{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-splade-form action="{{ route('register') }}" class="space-y-4">--}}
{{--            <x-splade-input id="name" type="text" name="name" :label="__('Name')" required autofocus />--}}
{{--            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required />--}}
{{--            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" />--}}
{{--            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required />--}}

{{--            <div class="flex items-center justify-end">--}}
{{--                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
{{--                    {{ __('Already registered?') }}--}}
{{--                </Link>--}}

{{--                <x-splade-submit class="ml-4" :label="__('Register')" />--}}
{{--            </div>--}}
{{--        </x-splade-form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}

<x-layouts.auth>
    <x-splade-form action="{{ route('register') }}" class="w-full h-max flex flex-col gap-4 items-center">
        <x-input id="first_name" type="text" name="first_name" v-model="form.first_name" placeholder="Name" required autofocus/>
        <x-input id="last_name" type="text" name="last_name" v-model="form.last_name" placeholder="Surname" required autofocus/>
        <x-input id="linkedin" type="text" name="linkedin" v-model="form.linkedin" placeholder="Linkedin" required autofocus/>
        <x-input id="email" type="email" name="email" v-model="form.email" placeholder="Email" required/>
        <x-input id="password" type="password" name="password" v-model="form.password" placeholder="Password" required
                 autocomplete="new-password"/>
        <x-button class="mt-10 lg:mt-20">
            Continue
        </x-button>
    </x-splade-form>
</x-layouts.auth>
