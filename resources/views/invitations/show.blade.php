<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Event Invitation: {{ $event->title }}
        </h2>
    </x-slot>

    <!-- mss -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-10">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded p-6">
            <p><strong>Start date:</strong> {{ $event->start_date->format('d/m/Y') }}</p>
            <p><strong>End date:</strong> {{ $event->end_date->format('d/m/Y') }}</p>

            <p><strong>Time:</strong> {{ $event->start_time }}</p>
            <p><strong>Country:</strong> {{ $event->country->name }}</p>
            <p><strong>Image:</strong></p>
          <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" width="200">


            <div class="mt-6 flex gap-4">
                <form method="POST" action="{{ route('invitations.respond', ['event' => $event->id, 'status' => 'accepted']) }}">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Accept Invitation
                    </button>
                </form>

                <form method="POST" action="{{ route('invitations.respond', ['event' => $event->id, 'status' => 'rejected']) }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Reject Invitation
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>