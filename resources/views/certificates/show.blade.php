<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Certificate') }}
        </h2>

        <!-- View All Courses Button -->
        <a href="{{ route('certificates.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Certificate
        </a>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Certificate Card -->
        <div class="bg-white p-6 rounded-lg shadow mt-10">
            <div class="flex items-start justify-between gap-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-1">Certificate Details</h1>

                    <div class="mt-4 space-y-2 text-sm text-gray-700">
                        <div><span class="font-semibold">Certificate #: </span>
                            {{ $certificate->id }}</div>
                        <div><span class="font-semibold">Student: </span>
                            <a href="{{ route('students.show', $certificate->student->id) }}"
                                class="text-blue-600 hover:underline">
                                {{ $certificate->student->name }}
                            </a>
                        </div>
                        <div>
                            <span class="font-semibold">Phone: </span> {{ $certificate->student->phone_number ?? '—' }}
                        </div>

                        @if(isset($certificate->course))
                            <div>
                                <span class="font-semibold">Course: </span> {{ $certificate->course->name }} <span
                                    class="text-xs text-gray-400">({{ $certificate->course->code }})</span>
                            </div>
                        @endif

                        <div><span class="font-semibold">Issue Date: </span>
                            {{ optional($certificate->created_at)->format('d M Y') ?? '—' }}</div>
                        <div><span class="font-semibold">Grade: </span>
                            {{ \Illuminate\Support\Str::title(str_replace(['_', '-'], ' ', $certificate->grade ?? '')) ?: '—' }}
                        </div>
                        <div><span class="font-semibold">Status: </span> {{ ucfirst($certificate->status) }}</div>
                    </div>
                </div>

                <div>
                    {{ $qrCode }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>