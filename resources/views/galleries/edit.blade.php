<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update', $gallery->id) }}" enctype="multipart/form-data"
                class="p-4 bg-white rounded-md space-y-2">
                @csrf
                @method('PUT')
                <div>
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-gray-900">Caption</label>
                    <input type="text" id="caption" name="caption"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        value="{{ old('caption', $gallery->caption) }}">
                    @error('caption')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-20 h-20">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        id="file_input" type="file" name="image">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
