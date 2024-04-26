@extends('layouts.app')
 
 @section('content')

 <div class="container py-3">
 <div class="row justify-content-center">
         <div class="col-md-5">
             <span>
                 <a href="{{ route('mypage') }}">マイページ</a> > 有料会員登録
             </span>
 
             <h1 class="mt-3 mb-3">有料会員登録</h1>
             <hr>

 <table>
    <tr>
      <th>有料プランの内容</th>
    </tr>
    <tr>
      <td>★店舗予約ができる！</td>
    </tr>
    <tr>
      <td>★お店のレビュー投稿ができる！</td>
    </tr>
	<tr>
      <td>★お店のお気に入り登録ができる！</td>
    </tr>
	<tr>
      <td>★月額たったの300円!</td>
    </tr>
  </table>
<hr>
  <h3 class="mb-3">ご登録フォーム</h3>

  <form action="{{route('subscription')}}" method="post" id="payment-form">
  @csrf
  
    <label for="exampleInputEmail1">お名前</label>
    <input type="test" class="form-control col-sm-5" id="card-holder-name" required>

    <label for="exampleInputPassword1">カード番号</label>
    <div class="form-group MyCardElement col-sm-12" id="card-element"></div>

    <div id="card-errors" role="alert" style='color:red'></div>

    <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">送信する</button>

    </form>
    </div>

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
