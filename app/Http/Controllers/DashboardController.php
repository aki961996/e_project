<?php

namespace App\Http\Controllers;

use App\Models\Attending;
use App\Models\Event;
use App\Models\Like;
use App\Models\SavedEvent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $totalEventCount = Event::count();

        $totalLikedCount = Like::where('user_id', auth()->user()->id)->count();
        $totalSavedCount = SavedEvent::where('user_id', auth()->user()->id)->count();
        $totalAttendedCount = Attending::where('user_id', auth()->user()->id)->count();



     
        return view('dashboard', compact('totalEventCount' ,'totalLikedCount', 'totalSavedCount', 'totalAttendedCount'));

    }
}
