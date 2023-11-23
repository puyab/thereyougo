@php
    use App\Models\Profile;
    $profile = Profile::query()
        ->where('id', auth()->user()->profile->id)
        ->select(['first_name', 'last_name', 'linkedin', 'role', 'company', 'location', 'telephone', 'accommodation_type', 'bedrooms', 'sleep_rooms', 'high_speed_wifi', 'features', 'longitude', 'latitude'])
        ->firstOrFail();
    $user = auth()->user();
    $images = [];
    foreach (['avatar', 'pic_1', 'pic_2', 'pic_3'] as $collection) {
        $images[$collection] = auth()
            ->user()
            ->profile->getFirstMediaUrl($collection);
    }
    $firstLogin = request()->cookie('first_login', false);
@endphp

<div class="w-full h-max">
    <div class="w-full h-max bg-[#d29a9a80] py-7 px-14 lg:py-14 lg:px-28 flex flex-row items-center justify-between">
        <span class="font-normal text-[#292D32] text-4xl lg:text-6xl">You’re in,
            {{ auth()->user()->profile->first_name }}.</span>
        <Link href="{{ auth()->user()->profile->canAccessProfile()? route('profile.global'): '#' }}">
        <x-feathericon-user class="w-12 h-12 text-white bg-black rounded-full p-2" />
        </Link>
    </div>
    <div class="flex flex-col items-center gap-11 mt-24 px-[46px] lg:px-[106px]">
        @if (!$firstLogin)
            <x-accordion title="1- Personal Information" :defaultOpen="true">
                <x-splade-form action="{{ route('profile.personal_information.update') }}"
                    class="flex flex-col items-center gap-20"
                    default="{{ json_encode(['first_name' => $profile->first_name, 'last_name' => $profile->last_name, 'linkedin' => $profile->linkedin, 'email' => $user->email]) }}">
                    <div
                        class="w-full h-max grid grid-cols-1 md:grid-cols-2 place-content-center place-items-start gap-y-6 gap-x-[105px]">
                        <x-input id="first_name" type="text" name="first_name" v-model="form.first_name"
                            placeholder="First Name *" required />
                        <x-input id="last_name" type="text" name="last_name" v-model="form.last_name"
                            placeholder="Last Name *" required />
                        <x-input id="linkedin" type="text" name="linkedin" v-model="form.linkedin"
                            placeholder="Linkedin *" required />
                        <x-input id="email" type="email" name="email" v-model="form.email" placeholder="Email *"
                            required />
                        <x-input id="current_password" type="text" name="current_password"
                            v-model="form.current_password" placeholder="Current Password *" />
                        <x-input id="password" type="text" name="password" v-model="form.password"
                            placeholder="Password *" />
                        <x-input id="password_confirmation" type="text" name="password_confirmation"
                            v-model="form.password_confirmation" placeholder="Confirm Password *" />
                    </div>
                    <x-button>Save and continue</x-button>
                </x-splade-form>
            </x-accordion>
        @endif
        <x-accordion title="{{ $firstLogin ? '1' : '2' }} - Submit Minimum Details" :defaultOpen="$firstLogin ? true : false">
            <x-splade-form default="{{ $profile->toJson() }}" action="{{ route('profile.details.update') }}"
                method="PATCH" class="flex flex-col items-center gap-20">
                <div class="w-full h-max grid grid-cols-1 md:grid-cols-2 place-items-center gap-x-[105px]">
                    <div class="w-full h-full flex flex-col gap-4 justify-between">
                        <x-input id="role" type="text" name="role" v-model="form.role"
                            placeholder="Current Role *" required />
                        <x-input id="company" type="text" name="company" v-model="form.company"
                            placeholder="Current Company *" required />
                        <x-input id="telephone" type="text" name="telephone" v-model="form.telephone"
                            placeholder="Telephone" required />
                        <address-input :form="form" :data="data" placeholder="Location"
                            name="location"></address-input>
                    </div>
                    <div class="w-full h-max flex flex-col justify-between gap-4">
                        <x-input id="accommodation_type" type="text" name="accommodation_type" type="select"
                            options="[['house','House'], ['apartment', 'Apartment'], ['room', 'Room']]"
                            placeholder="Type of accommodation" />
                        <x-input id="bedrooms" type="select"
                            options="[[0, '0'], [1,'1'], [2, '2'], [3, '3'], [4, '4'], [5, '5+']]" name="bedrooms"
                            key="bedrooms" placeholder="Number of bedrooms" />
                        <x-input id="sleep_rooms" name="sleep_rooms" type="select"
                            options="[[0, '0'], [1,'1'], [2, '2'], [3, '3'], [4, '4'], [5, '5+']]" key="sleep_rooms"
                            placeholder="How many sleeps" />
                        <x-input id="high_speed_wifi" type="select" options="[[true, 'Yes'], [false, 'No']]"
                            name="high_speed_wifi" key="high_speed_wifi" placeholder="High speed wi-fi" />
                    </div>
                </div>
                <x-button>Save and continue</x-button>
            </x-splade-form>
        </x-accordion>
        <x-accordion title="{{ $firstLogin ? '2' : '3' }} - Tick the box and tell us more about your place">
            <x-splade-data
                default="{options: ['Workstation', 'terrace', 'TV', 'Hair Dryer', 'Studio', 'Pool', 'AC', 'Towels', 'Ergonomic Chair', 'Garden', 'Oven', 'Shampoo', '2nd Screen', 'BBQ', 'Microwave', 'Bodywash', 'Co-working', 'Bicycle', 'Dishwasher', 'Coffee Machine']}">
                <x-splade-form default="{{ json_encode(['features' => $profile->features]) }}"
                    action="{{ route('profile.features.update') }}" method="PATCH"
                    class="flex flex-col items-center gap-20">
                    <div
                        class="w-full h-max grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-y-5 gap-x-4 place-items-center place-content-center">
                        <div class="flex items-center justify-center border-[0.72px] border-black rounded-full cursor-pointer py-2 w-[192px] transition-colors duration-300 hover:bg-gray-100 data-[active=true]:bg-gray-200"
                            v-for="feature in data.options"
                            :data-active="form.features.includes(feature.toLowerCase())"
                            @click="form.features.includes(feature.toLowerCase()) ? form.features = form.features.filter(f => f !== feature.toLowerCase()) : form.features.push(feature.toLowerCase())">
                            <span class="text-2xl font-light text-[#292D32]" v-text="feature"></span>
                        </div>
                    </div>
                    <x-button>Save and continue</x-button>
                </x-splade-form>
            </x-splade-data>
        </x-accordion>
        <div class="hidden">
            <x-accordion title="{{ $firstLogin ? '3' : '4' }} - Upload pictures of you and your place">
                <x-splade-data default="{{ json_encode($images) }}">
                    <x-splade-form action="{{ route('profile.images.upload') }}" method="POST"
                        class="flex flex-col items-center gap-20 pb-[51.5px] lg:pb-[103px]">
                        <div
                            class="relative w-full h-[820px] lg:h-[425px] max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-4 place-items-center place-content-center">
                            <file-input title="Your place 1" name="pic_1" :data="data"
                                :form="form"></file-input>
                            <div class="w-full h-max grid grid-cols-1 gap-5 place-content-center place-items-center">
                                <file-input max="202px" class="h-[202px] max-h-[202px]" title="Your place 2"
                                    name="pic_2" :data="data" :form="form"></file-input>
                                <file-input max="202px" class="h-[202px] max-h-[202px]" title="Your place 3"
                                    name="pic_3" :data="data" :form="form"></file-input>
                            </div>
                            <div
                                class="w-full h-[202px] flex items-center justify-center lg:rounded-full lg:overflow-hidden lg:w-[275px] lg:h-[265px] lg:border-[0.75px] lg:border-black lg:absolute z-20 left-0 top-[70%]">
                                <file-input title="Your picture" name="avatar"
                                    class="lg:min-w-[unset] lg:min-h-[unset] lg:w-[150%] lg:h-[120%]"
                                    :data="data" :form="form"></file-input>
                            </div>
                        </div>
                        <x-button>Save and continue</x-button>
                    </x-splade-form>
                </x-splade-data>
            </x-accordion>
        </div>
    </div>
</div>
