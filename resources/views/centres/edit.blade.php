<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Edit Centre') }}
        </h2>

        <!-- View All Centres Button -->
        <a href="{{ route('centres.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Centres
        </a>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Centre</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('centres.update', $centre) }}" method="post" class="space-y-6">
                @csrf
                @method('put')

                @if(session('message'))
                    <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
                @endif

                <!-- Centre Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Centre Name</label>
                    <input type="text" name="name" id="name" value="{{ $centre->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Centre Code -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Centre Code</label>
                    <input type="text" name="code" id="code" value="{{ $centre->code }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('centres.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Update Centre
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>