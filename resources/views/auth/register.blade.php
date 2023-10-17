<x-layouts.auth>
    <x-splade-form action="{{ route('register') }}" default="{referred_from: '{{request()->get('referred')}}'}" class="w-full h-max flex flex-col gap-4 items-center">
        <x-input id="first_name" type="text" name="first_name" v-model="form.first_name" placeholder="Name" required autofocus/>
        <x-input id="last_name" type="text" name="last_name" v-model="form.last_name" placeholder="Surname" required autofocus/>
        <x-input id="linkedin" type="text" name="linkedin" v-model="form.linkedin" placeholder="Linkedin" required autofocus/>
        <x-input id="email" type="email" name="email" v-model="form.email" placeholder="Email" required/>
        <x-input id="email" type="referred_from" name="referred_from" v-model="form.referred_from" hidden />
        <x-input id="password" type="password" name="password" v-model="form.password" placeholder="Password" required
                 autocomplete="new-password"/>
        <x-button class="mt-10 lg:mt-20">
            Continue
        </x-button>
    </x-splade-form>
</x-layouts.auth>
