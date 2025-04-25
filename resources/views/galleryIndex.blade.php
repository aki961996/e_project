@extends('layouts.main')
@section('content')
    <!-- component -->
    <section class="bg-white">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl">All Galleries</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($galleries as $gallery)
                    <div class="lg:flex bg-slate-100 rounded-md">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64"
                            src="{{ asset('/storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}">
                    </div>
                @endforeach
            </div>
            {{ $galleries->links() }}
        </div>
    </section>
    @endsection
