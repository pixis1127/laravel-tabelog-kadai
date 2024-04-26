<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
            'content' => 'required'
        ]);

        $review = new Review();
        $review->content = $request->input('content');
        $review->store_id = $request->input('store_id');
        $review->user_id = Auth::user()->id;
        $review->score = $request->input('score');
        $review->save();

        return back();
    }
    public function edit(Review $review)
    {
        if ($review->user_id == Auth::id()) 

        return view('stores.edit_review', compact('review'));

    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id == Auth::id()) 

        $review->content = $request->input('content');
        $review->score = $request->input('score');
        $review->save();

        return redirect('/stores')->with('flash_message', 'レビュー内容を編集しました。');
    }

    public function destroy(Review $review) {

        $review->delete();

        return redirect('/stores')->with('flash_message', 'レビューを削除しました。');
    }
}
