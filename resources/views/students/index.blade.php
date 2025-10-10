<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Students') }}
        </h2>

        <a href="{{ route('students.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Add Student
        </a>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Students</h1>

        @if(session('message'))
            <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Photo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Certificate ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Phone Number</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Centre / Course</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($students as $student)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="photo">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $student->certificate->id ?? '' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $student->mobile }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $student->course->code }}
                                {{ $student->course->name }} ({{ $student->centre->name }})
                            </td>
                            <td class="px-6 py-4 text-sm text-right space-x-2">

                                @if(!isset($student->certificate->id))
                                    <!-- Certificate Button -->
                                    <form action="{{ route('students.certificates.store', $student) }}" method="post"
                                        class="inline-block">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                            Student Certificated
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('certificate.pdf', $student->certificate->id) }}"
                                        class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Gentare Admit
                                        Card</a>
                                @endif

                                <!-- Delete button -->
                                <form action="{{ route('students.destroy', $student) }}" method="post" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this centre?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">
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
</x-layout>