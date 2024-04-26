<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_day' => 'required',
            'reservation_time' => 'required',
            'people' => 'required'
        ]);

        $reservation = new Reservation();
        $reservation->reservation_day = $request->input('reservation_day');
        $reservation->reservation_time = $request->input('reservation_time');
        $reservation->people = $request->input('people');
        $reservation->store_id = $request->input('store_id');
        $reservation->user_id = Auth::user()->id;
        $reservation->save();

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation ->delete();
    
            return redirect('/stores')->with('flash_message', '予約を削除しました。');
    }
}
