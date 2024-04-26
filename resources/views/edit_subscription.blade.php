@extends('layouts.app')
 
 @section('content')

 <div class="container py-3">
 <div class="row justify-content-center">
         <div class="col-md-5">
             <span>
                 <a href="{{ route('mypage') }}">マイページ</a> > クレジットカード変更
             </span>

             <h1 class="mt-3 mb-3">クレジットカード変更</h1>
             <p>{{$user->defaultPaymentMethod()->billing_details->name}}</p>
             <p>**** **** ****{{$user->pm_last_four}}</p>
             <form method="POST" action="{{ route('stripe.update') }}" id="payment-form">
                 @csrf
                 <label for="exampleInputEmail1">クレジットカード名義</label>
                 <input type="test" class="form-control col-sm-5" id="card-holder-name" required>

                 <label for="exampleInputPassword1">クレジットカード番号</label>
                 <div class="form-group MyCardElement col-sm-12" id="card-element"></div>

                 <div id="card-errors" role="alert" style='color:red'></div>

                 <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">変更する</button>
                 
                 
<script>
                    

// HTMLの読み込み完了後に実行するようにする
window.onload = my_init;
function my_init() {

    // Configに設定したStripeのAPIキーを読み込む  
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    var style = {
        base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
        color: "#aab7c4"
        }
    },
    invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
    }
    };
    
    const cardElement = elements.create('card', {style: style, hidePostalCode: true});
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        // formのsubmitボタンのデフォルト動作を無効にする
        e.preventDefault();
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                card: cardElement,
                billing_details: { name: cardHolderName.value }
                }
            }
        );
        
        if (error) {
        // エラー処理
        console.log('error');
        
        } else {
        // 問題なければ、stripePaymentHandlerへ
        stripePaymentHandler(setupIntent);
        }
    });
}

function stripePaymentHandler(setupIntent) {
var form = document.getElementById('payment-form');
var hiddenInput = document.createElement('input');
hiddenInput.setAttribute('type', 'hidden');
hiddenInput.setAttribute('name', 'stripePaymentMethod');
hiddenInput.setAttribute('value', setupIntent.payment_method);
form.appendChild(hiddenInput);
// フォームを送信
form.submit();
}
</script>
                        


@endsection