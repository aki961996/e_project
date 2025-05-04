<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Events') }}
            </h2>
            <div>
                <a href="{{ route('events.create') }}" class="text-blue-600 hover:underline">+ New Event</a>
            </div>
        </div>
    </x-slot>

    <!-- Success Message -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md">
            {{ session('success') }}
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Created Events --}}
            <div class="mb-10">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Your Events</h3>
                <div class="overflow-x-auto bg-white rounded shadow">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-md text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Country</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $event->title }}</td>
                                <td class="px-6 py-4">{{ $event->start_date }}</td>
                                <td class="px-6 py-4">{{ $event->country->name }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('invitations.form', ['event' => $event->id]) }}"
                                            class="text-yellow-600 hover:text-yellow-800">Invite</a>

                                        <a href="{{ route('events.edit', $event) }}"
                                            class="text-green-600 hover:text-green-800">Edit</a>

                                        <form method="POST" action="{{ route('events.destroy', $event) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No events found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{--  Accepted Events Section (moved below the created events list) --}}
            @if(isset($acceptedEvents) && $acceptedEvents->count())
            <div class="mt-10">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Events You've participants.</h3>
                @foreach($acceptedEvents as $acceptedEvent)
                <div class="mb-4 p-4 bg-white rounded shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">{{ $acceptedEvent->title }}</h4>
                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($acceptedEvent->start_date)->format('d/m/Y') }}
                                to
                                {{ \Carbon\Carbon::parse($acceptedEvent->end_date)->format('d/m/Y') }}
                                at {{ \Carbon\Carbon::parse($acceptedEvent->start_time)->format('H:i A') }}
                            </p>
                            <p class="text-sm text-gray-500">Address: {{ $acceptedEvent->address }}</p>

                            @php
                            $status = $acceptedEvent->pivot->status ?? 'N/A';
                            $statusColor = match($status) {
                            'accepted' => 'text-green-600',
                            'rejected' => 'text-red-600',
                            default => 'text-gray-600',
                            };
                            @endphp

                            <p class="text-sm text-gray-500">
                                Status:
                                <span class="font-semibold {{ $statusColor }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </p>
                            <!-- <p class="text-sm text-gray-500">
                                Status:
                                <span class="font-semibold text-green-600">{{ ucfirst($acceptedEvent->pivot->status ?? 'N/A') }}</span>
                            </p> -->

                        </div>
                        <div>
                            <a href="{{ route('events.show', $acceptedEvent->id) }}"
                                class="text-blue-600 hover:underline">View Event</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Events the user is invited to --}}
            @if(isset($invitedEvents) && count($invitedEvents))
            <div class="mt-10">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Events You're Invited To</h3>
                @foreach($invitedEvents as $invitedEvent)
                <div class="mb-4 p-4 bg-white rounded shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">{{ $invitedEvent->title }}</h4>
                            <p class="text-sm text-gray-600">
                                {{ $invitedEvent->start_date->format('d/m/Y') }}
                                to
                                {{ $invitedEvent->end_date->format('d/m/Y') }}
                                at {{ $invitedEvent->start_time }}
                            </p>
                            <!-- <p class="text-sm text-gray-500">
                                Status:
                                <span class="font-semibold text-green-600d">{{ ucfirst($invitedEvent->pivot->status ?? 'Pending') }}</span>
                            </p> -->
                            @php
                            $status = $invitedEvent->pivot->status ?? 'N/A';
                            $statusColor = match($status) {
                            'accepted' => 'text-green-600',
                            'rejected' => 'text-red-600',
                            default => 'text-gray-600',
                            };
                            @endphp

                            <p class="text-sm text-gray-500">
                                Status:
                                <span class="font-semibold {{ $statusColor }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </p>

                            <!-- <p class="text-sm text-gray-500">
                                Status:
                                <span class="font-semibold text-green-600">{{ ucfirst($invitedEvent->pivot->status ?? 'N/A') }}</span>
                            </p> -->
                        </div>
                        <div>
                            <a href="{{ route('invitations.view', $invitedEvent->id) }}"
                                class="text-blue-600 hover:underline">View Invitation</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</x-app-layout>