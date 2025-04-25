<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class StoreCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request, $id)
    // {
    //     $event = Event::findOrFail($id);
    //     $event->comments()->create([
    //         'content' => $request->content,
    //         'user_id' => auth()->id()
    //     ]);

    //     return back();
    // }

    public function __invoke(Request $request, $id)
{
    try {
        $event = Event::findOrFail($id);

        $event->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Comment added successfully!');
    } catch (ModelNotFoundException $e) {
        // Event not found
        return back()->with('error', 'Event not found!');
    } catch (Exception $e) {
        // Log the actual error for debugging
        Log::error('Comment creation failed: ' . $e->getMessage());

        return back()->with('error', 'Something went wrong. Please try again.');
    }
}
}
