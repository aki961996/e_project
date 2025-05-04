<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function showForm(Event $event)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('invitations.form', compact('event', 'users'));
    }

    public function send(Request $request, Event $event)
    {

        $request->validate([
            'user_ids' => 'required|array'
        ]);
        foreach ($request->user_ids as $userId) {
            $event->invitedUsers()->syncWithoutDetaching([$userId => ['status' => 'pending']]);
        }

        return redirect()->back()->with('success', 'Invitations sent.');
    }

    public function viewInvitation(Event $event)
    {



        $isInvited = $event->invitedUsers()->where('user_id', auth()->id())->exists();



        if (! $isInvited) {
            abort(403, 'You are not invited to this event.');
        }
        return view('invitations.show', compact('event'));
    }


    // public function respond(Event $event, $status)
    // {

    //     if (!in_array($status, ['accepted', 'rejected'])) {
    //         abort(400);
    //     }

    //     $event->invitedUsers()->updateExistingPivot(auth()->id(), ['status' => $status]);

    //     $message = $status === 'accepted' ? 'Invitation accepted successfully.' : 'Invitation rejected.';

    //     return redirect()->back()->with('success', $message);

    //     // return redirect()->back()->with('success', 'Invitation accepted successfully.');

    // }

    public function respond(Request $request, Event $event, $status)
    {
        $user = auth()->user();


        if (!in_array($status, ['accepted', 'rejected'])) {
            abort(400, 'Invalid response.');
        }


        if (! $event->invitedUsers()->where('user_id', $user->id)->exists()) {
            abort(403, 'You are not invited to this event.');
        }


        $event->invitedUsers()->updateExistingPivot($user->id, [
            'status' => $status === 'accepted' ? 'accepted' : 'rejected',
        ]);

        return redirect()->route('events.show', $event->id)
        ->with('success', "You have {$status} the invitation.");
        // return redirect()->route('events.index')->with('success', 'Your response has been successfully recorded.');
    }
}
