<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Participants: {{ $event->slug }}
        </h2>
    </x-slot>

    {{-- Success message --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded p-6">


            <!-- <p><strong>Start Date:</strong> {{ $event->start_date->format('d/m/Y') }}</p>
            <p><strong>End Date:</strong> {{ $event->end_date->format('d/m/Y') }}</p>
            <p><strong>Time:</strong> {{ $event->start_time }}</p>
            <p><strong>Address:</strong> {{ $event->address }}</p>
            
            <p><strong>Country:</strong> {{ $event->country->name }}</p> -->

            @forelse($participants as $participant)
        <li>{{ $participant->name }}</li>
        <li>{{ $participant->email }}</li>
    @empty
        <li>No participants yet.</li>
    @endforelse

            @if ($event->image)
                <div class="mt-4">
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" width="200">
                </div>
            @endif

          
        </div>
    </div>
</x-app-layout>
