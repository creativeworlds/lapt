<x-layout title="Verification">
    <main class="verification-page">
        <h1>{{ App\Support\Verification::decode(request()->fileName) }}</h1>
    </main>
</x-layout>