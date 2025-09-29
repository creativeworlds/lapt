<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Genrate Certificate') }}
        </h2>

        <!-- View All Courses Button -->
        <a href="{{ route('certificates.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Certificate
        </a>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Gentare Certificate</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('certificates.store') }}" method="post" class="space-y-6">
                @csrf

                @if(session('message'))
                    <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
                @endif

                <!-- Select Student -->
                <div>
                    <label for="studentId" class="block text-sm font-medium text-gray-700">Student</label>
                    <select name="student_id" id="studentId" onchange="getCourses(this.value)"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Course -->
                <div>
                    <label for="courseId" class="block text-sm font-medium text-gray-700">Course</label>
                    <select name="course_id" id="courseId"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">-- Select Course --</option>
                    </select>
                    @error('course_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Status -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="status" id="status" value="{{ old('status') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Grade -->
                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                    <input type="text" name="grade" id="grade" value="{{ old('grade') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('grade')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('certificates.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Gentare Certificate
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const getCourses = async (studentId) => {
            const courseSelect = document.getElementById('courseId');
            const courses = await (await fetch(`/student/${studentId}/courses`)).json();

            // Clear old options
            courseSelect.innerHTML = '<option value="">-- Select Course --</option>';

            // Add new options
            courses.forEach(course => {
                let opt = document.createElement('option');
                opt.value = course.id;
                opt.textContent = course.name + (course.code ? ` (${course.code})` : '');
                courseSelect.appendChild(opt);
            });
        }
    </script>
</x-app-layout>