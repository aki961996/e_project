<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Requisition List for {{ $event->title }}
        </h2>
    </x-slot>

    @if(session('success'))
    <p class="text-green-600 px-4">{{ session('success') }}</p>
    @endif


    @php
    $isOwner = auth()->id() === $event->user_id;


    @endphp

    @if($isOwner && now()->lt($event->start_date))
    <form method="POST" action="{{ route('requisition.store', $event->id) }}" class="p-4">
        @csrf
        <input type="text" name="item" placeholder="Item name" class="border p-1" required>
        <select name="visibility" class="border p-1">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Add</button>
    </form>
    @endif

    <ul class="px-4 mt-4 space-y-2">
        @foreach($items as $item)
        <li class="border p-2 rounded">
            {{ $item->item }}
            @if(!$item->claimed && now()->lt($event->date))
            <form method="POST" action="{{ route('requisition.claim', $item->id) }}" class="inline">
                @csrf
                <button type="submit" class="ml-2 text-blue-500 hover:underline">Claim</button>
            </form>
            @elseif($item->claimed)
            <span class="ml-2 text-gray-500">- Claimed by {{ $item->claimer->name ?? 'Someone' }}</span>
            @endif
        </li>
        @endforeach
    </ul>
</x-app-layout>