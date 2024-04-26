@extends('layouts.app')
 
 @section('content')
 
 <div class="d-flex justify-content-center">
     <div class="row w-75">
         <div class="col-5 offset-1">
             <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fluid">
         </div>
         <div class="col">
             <div class="d-flex flex-column">
                 <h1 class="">
                     {{$store->name}}
                 </h1>
                 @if ($store->reviews()->exists())
                     <p>
                         <span class="kadai_002-star-rating" data-rate="{{ round($store->reviews->avg('score') * 2) / 2 }}"></span>
                         {{ round($store->reviews->avg('score'), 1) }}
                     </p>
                 @endif
                 <p class="">
                     {{$store->description}}
                 </p>
                 <hr>
                 <p class="d-flex align-items-end">
                     ￥{{$store->price}}(税込)
                 </p>
                 <p class="d-flex align-items-end">
                     営業時間 {{$store->business_hours}}
                 </p>
                 <p class="d-flex align-items-end">
                     定休日 {{$store->regular_holiday}}
                 </p>
                 <p class="d-flex align-items-end">
                     住所 <br>
                     〒{{$store->post_code}} <br>
                     {{$store->address}}
                 </p>
                 <p class="d-flex align-items-end">
                     電話番号 {{$store->phone_number}}
                 </p>
                 <hr>
             </div>
             @auth
             <form method="POST" class="m-3 align-items-end">
                 @csrf
                 <input type="hidden" name="id" value="{{$store->id}}">
                 <input type="hidden" name="name" value="{{$store->name}}">
                 <input type="hidden" name="price" value="{{$store->price}}">
                 <div class="row">
                     <div class="col-5">                        
                        @if($store->isFavoritedBy(Auth::user()))
                         <a href="{{ route('stores.favorite', $store) }}" class="btn kadai_002-favorite-button text-favorite w-100">
                             <i class="fa fa-heart"></i>
                             お気に入り解除
                         </a>
                         @else
                         <a href="{{ route('stores.favorite', $store) }}" class="btn kadai_002-favorite-button text-favorite w-100">
                             <i class="fa fa-heart"></i>
                             お気に入り
                         </a>
                         @endif
                     </div>
                 </div>
             </form>
             <div class="offset-1 col-11">
             <hr class="w-100">
             <h3 class="float-left">予約</h3>
             <div class="w-100">
                 <div class="offset-1 col-11">
                     <form method="POST" action="{{ route('reservations.store') }}">
                         @csrf
                         <h4>予約日</h4>
                         <input type="date" name="reservation_day" class="form-control m-2">
                         <h4>時間</h4>
                         <select name="reservation_time" class="form-control m-2">
                                 <option>選択してください</option>
                                 <option value="10:00">10:00</option>
                                 <option value="11:00">11:00</option>
                                 <option value="12:00">12:00</option>
                                 <option value="13:00">13:00</option>
                                 <option value="14:00">14:00</option>
                                 <option value="15:00">15:00</option>
                                 <option value="15:00">16:00</option>
                                 <option value="15:00">17:00</option>
                                 <option value="15:00">18:00</option>
                                 <option value="15:00">19:00</option>
                                 <option value="15:00">20:00</option>
                             </select>
                         <h4>人数</h4>
                         <select name="people" class="form-control m-2">
                                 <option>選択してください</option>
                                 <option value="1">1人</option>
                                 <option value="2">2人</option>
                                 <option value="3">3人</option>
                                 <option value="4">4人</option>
                                 <option value="5">5人</option>
                                 <option value="6">6人</option>
                                 <option value="7">7人</option>
                                 <option value="8">8人</option>
                                 <option value="8">9人</option>
                                 <option value="8">10人</option>
                             </select>
                         <input type="hidden" name="store_id" value="{{$store->id}}">
                         <button type="submit" class="btn kadai_002-submit-button ml-2">予約する</button>
                     </form>
                 </div>
             </div>
         </div>
                 <form id="favorites-store-form" action="{{ route('stores.favorite', $store->id) }}" method="POST" class="d-none">
                     @csrf
                 </form>
             @endauth
         </div>
 
         <div class="offset-1 col-11">
             <hr class="w-100">
             <h3 class="float-left">カスタマーレビュー</h3>
         </div>
         <div class="offset-1 col-10">
         <div class="w-100">
                 @foreach($reviews as $review)
                 <div class="float-left">
                 <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                     <p class="h3">{{$review->content}}</p>
                     <label>{{$review->created_at}} {{$review->user->name}}</label>
                 </div>
                 @if ($review->user_id === Auth::id())
                 <a href="{{ route('reviews.edit', $review) }}"><button type="submit" class="btn kadai_002-submit-button ml-2">編集</button></a>
                 <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn kadai_002-delete-submit-button">削除</button>
                 </form>
             @endif
                 @endforeach
             </div><br />
 
             @auth
             <div class="w-100">
                 <div class="offset-1 col-11">
                     <form method="POST" action="{{ route('reviews.store') }}">
                         @csrf
                         <h4 class="float-left">評価</h4>
                             <select name="score" class="form-control m-2 review-score-color">
                                 <option value="5" class="review-score-color">★★★★★</option>
                                 <option value="4" class="review-score-color">★★★★</option>
                                 <option value="3" class="review-score-color">★★★</option>
                                 <option value="2" class="review-score-color">★★</option>
                                 <option value="1" class="review-score-color">★</option>
                             </select>
                         <h4>レビュー内容</h4>
                         @error('content')
                             <strong>レビュー内容を入力してください</strong>
                         @enderror
                         <textarea name="content" class="form-control m-2"></textarea>
                         <input type="hidden" name="store_id" value="{{$store->id}}">
                         <button type="submit" class="btn kadai_002-submit-button ml-2">レビューを追加</button>
                     </form>
                 </div>
             </div>
             @endauth
         </div>
     </div>
 </div>
 @endsection