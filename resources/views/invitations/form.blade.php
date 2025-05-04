<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invite Users to <span class="text-blue-600">{{ $event->title }}</span>
            </h2>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4">
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form method="POST" action="{{ route('invitations.send', $event->id) }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Select Users to Invite:</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($users as $user)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span>{{ $user->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Send Invitations
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
