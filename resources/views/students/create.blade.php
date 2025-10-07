<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Add Student') }}
        </h2>

        <!-- View All Centres Button -->
        <a href="{{ route('students.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Students
        </a>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Add New Student</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('students.store') }}" method="post" class="space-y-6" enctype="multipart/form-data">
                @csrf

                @if(session('message'))
                    <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Service Provider</label>
                        <select name="centre_id" id="centreId" onchange="getCourses(this.value)"
                            class="w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                            <option value="">-- Select Centre --</option>
                            @if (isset($centre->id))
                                <option value="{{ $centre->id }}" selected>
                                    {{ $centre->city }} ({{ $centre->name }})
                                </option>
                            @else
                                @foreach ($centres as $c)
                                    <option value="{{ $c->id }}" @selected(old('centre_id') == $c->id)>
                                        {{ $c->city }} ({{ $c->name }})
                                    </option>
                                @endforeach
                            @endif
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Course</label>
                        <select name="course_id" class="w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm"
                            required id="courseId">
                            <option value="">-- Select Course --</option>
                            @if (isset($centre->id))
                                @foreach($centre->courses as $course)
                                    <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                        {{ $course->code }} {{ $course->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input name="name" type="text" value="{{ old('name') }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Care Of</label>
                        <input name="care_of" type="text" value="{{ old('care_of') }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sex</label>
                        <select name="sex" class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm"
                            required>
                            <option value="">-- Select Sex --</option>
                            <option value="male" @selected(old('sex') == 'male')>Male</option>
                            <option value="female" @selected(old('sex') == 'female')>Female</option>
                            <option value="other" @selected(old('sex') == 'other')>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Session / Batch</label>
                        <input name="session" type="text" value="{{ old('session') }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload Photo</label>
                        <input type="file" name="photo" accept="image/*" class="mt-1 w-full text-sm text-gray-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload ID Card</label>
                        <input name="id_card" type="file" class="mt-1 w-full text-sm text-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Education Proof</label>
                        <input name="education_proof" type="file" class="mt-1 w-full text-sm text-gray-600">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload Other Document</label>
                        <input name="other_doc" type="file" class="mt-1 w-full text-sm text-gray-600">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Academic Qualification</label>
                        <input name="qualification" type="text" value="{{ old('qualification') }}" required
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telephone</label>
                        <input name="telephone" type="text" value="{{ old('telephone') }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Email</label>
                        <input name="email_confirmation" type="email" value="{{ old('email_confirmation') }}" required
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <input name="mobile" type="text" value="{{ old('mobile') }}" required
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fax</label>
                        <input name="fax" type="text" value="{{ old('fax') }}"
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address_line" rows="5" required
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">{{ old('address_line') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Details</label>
                        <textarea name="details" rows="5" required
                            class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">{{ old('details') }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input name="password" type="password" required
                        class="mt-1 w-full bg-gray-50 border border-gray-200 rounded-md p-3 text-sm">
                </div>

                <div class="flex items-center space-x-3">
                    <input id="agree" name="agree" type="checkbox" checked required
                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded" {{ old('agree') ? 'checked' : '' }}>
                    <label for="agree" class="text-sm text-gray-700">Accept Terms and Conditions</label>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('students.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const getCourses = async (centreId) => {
            const courseSelect = document.getElementById('courseId');
            const courses = await (await fetch(`/centres/${centreId}/courses`)).json();

            // Clear old options
            courseSelect.innerHTML = '<option value="">-- Select Course --</option>';

            // Add new options
            courses.forEach(course => {
                let opt = document.createElement('option');
                opt.value = course.id;
                opt.textContent = `${course.code} ${course.name}`;
                courseSelect.appendChild(opt);
            });
        }
    </script>
</x-app-layout>