<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Student Detail') }}
        </h2>

        <a href="{{ route('students.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Students
        </a>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Student Detail</h1>

        <div class="max-w-4xl mx-auto space-y-6">

            <!-- Student Info -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Student Details</h2>
                <div class="space-y-2">
                    <p><span class="font-semibold">Name:</span> {{ $student->name }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $student->email ?? '-' }}</p>
                    <p><span class="font-semibold">Phone Number:</span> {{ $student->phone_number ?? '-' }}</p>
                    <p><span class="font-semibold">Centre:</span> {{ $student->centre->name ?? '—' }}
                        ({{ $student->centre->code ?? '' }})</p>
                </div>
            </div>

            <!-- Allotted Courses -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Allotted Courses</h2>

                @if($student->courses->isEmpty())
                    <div class="p-4 bg-yellow-50 text-yellow-800 rounded">No courses allotted yet.</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3 text-sm">Course</th>
                                    <th class="p-3 text-sm">Allotted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->courses as $course)
                                    <tr class="border-t">
                                        <td class="p-3">
                                            <div class="font-medium">{{ $course->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $course->code }}</div>
                                        </td>
                                        <td class="p-3">{{ optional($course->created_at)->format('d M Y') ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Add Course Form -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Add New Course</h2>

                <form action="{{ route('student.courseAllotment', $student->id) }}" method="post" class="space-y-4">
                    @csrf

                    @if(session('message'))
                        <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
                    @endif


                    <!-- Course Select -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Course</label>
                        <select name="course_id" required class="mt-1 w-full px-3 py-2 border rounded">
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                            @endforeach
                        </select>
                        @error('course_id') <small class="text-red-600">{{ $message }}</small> @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700">
                            Add Course
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>