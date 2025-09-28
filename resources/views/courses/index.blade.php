<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Courses') }}
        </h2>

        <a href="{{ route('courses.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Add Course
        </a>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-2xl font-bold mb-6">Courses</h1>

            @if(session('message'))
                <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
            @endif

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Code</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Centre</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($courses as $course)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $course->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $course->code }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $course->centre->name }}</td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <!-- Edit button -->
                                    <a href="{{ route('courses.edit', $course) }}" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Edit
                                    </a>

                                    <!-- Delete button -->
                                    <form action="{{ route('courses.destroy', $course) }}" method="post" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this centre?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>