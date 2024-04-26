@extends('layouts.app')
 
 @section('content')

 <div class="container py-3">
 <div class="row justify-content-center">
         <div class="col-md-5">
             <span>
                 <a href="{{ route('mypage') }}">マイページ</a> > 有料会員解約
             </span>
 
             <h1 class="mt-3 mb-3">有料会員解約</h1>
             <hr>
             <p>有料会員を解約すると以下の特典を受けられなくなります。<br>
            本当に解約してよろしいですか？</p>

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
<div class="form-group d-flex justify-content-center">
<form method="POST" action="{{route('stripe.cancel', $user) }}">
  @csrf
             <button type="submit" class="btn btn-danger w-100">
                 解約
             </button>
         </div>

@endsection