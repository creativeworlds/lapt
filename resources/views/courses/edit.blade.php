<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Edit Course') }}
        </h2>

        <!-- View All Courses Button -->
        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Courses
        </a>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Course</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('courses.update', $course) }}" method="post" class="space-y-6">
                @csrf
                @method('put')

                @if(session('message'))
                    <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
                @endif

                <!-- Centre Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                    <input type="text" name="name" id="name" value="{{ $course->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Course Code -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Course Code</label>
                    <input type="text" name="code" id="code" value="{{ $course->code }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Centre -->
                <div>
                    <label for="centreId" class="block text-sm font-medium text-gray-700">Centre</label>
                    <select name="centre_id" id="centreId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">-- Select Centre --</option>
                        @foreach($centres as $centre)
                            <option value="{{ $centre->id }}" {{ $course->centre_id == $centre->id ? 'selected' : '' }}>
                                {{ $centre->name }} ({{ $centre->code }})
                            </option>
                        @endforeach
                    </select>
                    @error('centre_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('courses.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>