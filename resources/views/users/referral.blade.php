<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite Friends to Shifft and Manage Invitation Codes') }}
        </h2>
    </x-slot>
    <x-success-alert />
    <x-error-alert />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-6 ml-4">
                    {{ __('Invitation Codes') }}
                </h2>
                <div class="flex justify-end mt-6 mr-4">
                    <form method="POST" action="{{ route('get.referrer.link') }}">
                        @csrf
                        <div>
                            <x-input id="redeemer" class="block mt-1" placeholder="Name of Invitee" type=" text" name="redeemer" :value="null" required autofocus style="display: inline;" />
                            <x-button class="ml-4">{{ __('Generate New Code') }}</x-button>
                        </div>
                        <!-- <div> -->
                        <!-- </div> -->
                    </form>
                    <!-- <a href="{{ route('get.referrer.link') }}" style="background-color: #276ebe; margin-right: 25px" class="btn bg-blue-500 hover:bg-blue-700 text-white m-3 font-bold py-2 px-4 rounded">
                        {{ __('Generate Invitation Code') }}
                    </a> -->
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-invitation-links :invitation-links="$refCodes" />
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-6 ml-4">
                    {{ __('Referral Hierarchy Tree') }}
                </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Insert Tree here --}}
                    <div class="tf-tree example">
                        <ul>
                            @foreach ($hierarchicalData as $hierarchyNode)
                            <li>
                                <span class="tf-nc">{{ $hierarchyNode['user']->name }}</span>
                                @if (count($hierarchyNode['children']) > 0)
                                @include('partials.treeflex', ['hierarchicalData' => $hierarchyNode['children']])
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- End Tree --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
