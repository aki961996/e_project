<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Mail\EventCreated;
use App\Models\Country;
use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {


        $events = Event::with('country')->get();


        //  $invitedEvents = auth()->user()->invitedEvents()->with('creator')->get();
        $invitedEvents = auth()->user()->invitedEvents()->get();
        $acceptedEvents = auth()->user()->acceptedEvents()->get();


        if ($acceptedEvents->isNotEmpty()) {
            foreach ($acceptedEvents as $acceptedEvent) {
                $status = $acceptedEvent->pivot->status;
                // echo "Event ID: {$acceptedEvent->id} - Status: {$status}<br>";
            }
        }


        return view('events.index', compact('events', 'invitedEvents', 'acceptedEvents'));
    }

    public function show($id){
        $event = Event::with('country')->findOrFail($id);
        $participants = $event->participants; // Only accepted users
    
        return view('events.show', compact('event', 'participants'));
        // return view('events.show', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();

        $tags = Tag::all();

        return view('events.create', compact('countries', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request): RedirectResponse
    {
        if ($request->hasFile('image')) {

            $data = $request->validated();
            // $data['image'] = Storage::putFile('events', $request->file('image'));
            // Store in 'public/events'
            $data['image'] = $request->file('image')->store('events', 'public');
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);

            $event = Event::create($data);


            $event->tags()->attach($request->tags);

            // Send email to logged-in user m
            // Mail::to(auth()->user()->email)->send(new EventCreated($event));
            return to_route('events.index');
        } else {
            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.edit', compact('countries', 'tags', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            // $data['image'] = Storage::putFile('events', $request->file('image'));
            // Store in 'public/events'
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['slug'] = Str::slug($request->title);
        $event->update($data);
        $event->tags()->sync($request->tags);
        return to_route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();
        return to_route('events.index');
    }
}
