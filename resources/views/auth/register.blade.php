<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            Please fix the following errors:
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <x-error-alert />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="relative h-0" style="padding-bottom: 10.25%">
            <video class="top-0 left-0 w-full h-full" playsinline poster="{{ asset('assets/images/placeholder-03.png') }}" controls loop style="overflow-y: hidden;">
                <source src="https://res.cloudinary.com/dxkd6xlpq/video/upload/v1676956564/ca9dd09a-d23b-4da1-8cc0-a3aaae004047_qlobke.mov" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('First Name')" />

                <x-input id="firstname" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>
            
            <div class="mt-4">
                <x-label for="name" :value="__('Last Name')" />

                <x-input id="lastname" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- What do you believe in? -->
            <div class="mt-4">
                <x-label for="believe" :value="__('Please affirm your shared belief in our 7 core belief statements in order to join the SHIFFT Community')" />

                <label></label><br>
                @foreach($beliefs as $belief)
                <input type="checkbox" name="believe[]" value="{{ $belief->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><span class="ml-2 text-sm text-gray-700" style="color: #374151;"> {{ ucwords($belief->name ?? '')}} </span> <br>
                <span class="ml-2 text-sm text-gray-600">{{ $belief->description }}</span><br><br>
                </span>
                @endforeach

            </div>

            <!-- Referral Code -->
            <div class="mt-4">
                <x-label for="email" :value="__('Referral Code')" />

                <input id="ref_code" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="ref_code" value="{{Cookie::get('ref_code')}}" @if(Cookie::get('ref_code')) disabled @endif required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="block mt-4">
                <label for="accept_terms" class="inline-flex items-center">
                    <input id="accept_terms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">I have read and agree to the <a href="{{ route('privacy.policy') }}">SHIFFT Privacy Policy</a>, <a href="{{ route('terms.service') }}">Terms of Service</a>, and Community Bylaws</span>
                </label>
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Are you ready to Join the SHIFFT Community?')" /><br>
                <span class="ml-2 text-sm text-gray-600">SHIFFT is a grassroots movement that applies the principles on which Canada was founded, drawn from the Judeo-Christian tradition, to various dimensions of life for true human flourishing under the principles of God’s rule. The movement intends to focus on the seven mountains: Spiritual, Health, Information, Finances, Freedom, Truth, and Justice, and to equip a community of influencers to model freedom and abundance while uncovering truth, promoting health, and helping individuals find hope. The ultimate goal of SHIFFT is to create a preferred future of hope and freedom for all Canadians.</span><br>
                <span class="ml-2 text-sm text-gray-600">We are committed to being active stakeholders in Projects that align with our vision for a better world. Our focus on spiritual, health, information, freedom, financial, truth, and justice guides our involvement in initiatives that promote positive change. By collaborating with like-minded individuals and organizations, we are dedicated to making a meaningful impact on the world around us.</span><br>
                <span class="ml-2 text-sm text-gray-600">SHIFFT aims to create a strong, independent community and network through passionate and convicted influencers who will begin a movement across Canada. While starting locally in Alberta, SHIFFT aims to stand against tyranny and utilize practical experience to create a healthy society. Over the past three years, 300+ Freedom groups and hundreds of Freedom minded communities have been created, and SHIFFT's goal is to help create the necessary synergy and unity so this movement can thrive.</span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already a member?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Join') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
