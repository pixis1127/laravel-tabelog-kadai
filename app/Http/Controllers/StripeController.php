<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\User;

class StripeController extends Controller
{
public function subscription(Request $request){
    $user=Auth::user();
        return view('subscription',  [
            'intent' => $user->createSetupIntent()
        ]);
    }

    public function afterpay(Request $request){
        
        $user=Auth::user();
        
        $stripeCustomer = $user->createOrGetStripeCustomer();

        $paymentMethod=$request->input('stripePaymentMethod');

        $plan=('price_1P5TPxHTnh3jrMhWtnF2vJpp');
        
        $user->newSubscription('default', $plan)
        ->create($paymentMethod);

        return redirect()->route('mypage');
    }

    public function edit_subscription(Request $request){
        $user=Auth::user();
        $intent=$user->createSetupIntent();
        return view('/edit_subscription', compact('intent', 'user'));
    }
   
    public function stripe_update(Request $request) {
        $paymentMethod = $request->input('stripePaymentMethod'); 
        Auth::user()->updateDefaultPaymentMethod($paymentMethod);
        return back()->with(["お支払い方法を変更しました。"]);
    }


    public function stripe_cancel(Request $request){
        $user=Auth::user();
        return view('/cancel_subscription', compact('user'));
    }

    public function cancel_subscription(User $user, Request $request){
       
        $user=Auth::user();

        $user->subscription('default')->cancelNow();

        return redirect('/subscription');
     }
}
