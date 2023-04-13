<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-4">
            @foreach ($ads as $ad)
            <div class="bg-white rounded-lg shadow p-6">
                <a href="{{ route('ads.show', $ad) }}">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $ad->title }}</h2>
                        <p class="text-gray-600">{{ $ad->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="mb-4">
                        <img src="{{ $ad->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $ad->title }}" class="w-full">
                    </div>
                    <div class="mb-4">
                        <p class="text-gray-700">{{ $ad->description }}</p>
                    </div>
                    <div class="text-right">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('View Ad') }}
                        </button>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
