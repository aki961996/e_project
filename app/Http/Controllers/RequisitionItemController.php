<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\RequisitionItem;
use Illuminate\Http\Request;

class RequisitionItemController extends Controller
{
     public function index(Event $event)
    {
        $event = Event::with('requisitionItems')->findOrFail($event->id);
      
        $items = $event->requisitionItems;
        return view('requisition.index', compact('event', 'items'));
    }

    public function store(Request $request, Event $event)
    {
      
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'item' => 'required|string',
            'visibility' => 'required|in:public,private'
        ]);

        RequisitionItem::create([
            'event_id' => $event->id,
            'item' => $request->item,
            'visibility' => $request->visibility,
        ]);

        return redirect()->back()->with('success', 'Item successfully added.');
    }
    public function claim(RequisitionItem $item)
    {
        if ($item->claimed) return back()->with('error', 'Already claimed.');

        $item->update([
            'claimed' => true,
            'claimed_by' => auth()->id(),
        ]);

        return back()->with('success', 'Item claimed.');
    }
}
