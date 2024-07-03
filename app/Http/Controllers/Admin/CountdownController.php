<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countdown;

class CountdownController extends Controller
{
    public function index()
    {
        $countdown = Countdown::first();
        return view('admin.countdown.index', [
            'title' => "ADMINPANEL | Countdown Management",
            'countdown' => $countdown
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'target_date' => 'required|date',
        ]);

        $countdown = Countdown::first();
        if (!$countdown) {
            $countdown = new Countdown();
        }

        $countdown->target_date = $request->target_date;
        $countdown->save();

        return redirect()->route('admin.countdown.index')->with('success', 'Countdown updated successfully');
    }
}
