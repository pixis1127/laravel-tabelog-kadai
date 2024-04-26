@extends('layouts.app')
 
 @section('content')

@auth
             <div class="w-100">
                 <div class="offset-1 col-11">
                     <form method="POST" action="{{ route('reviews.update', $review) }}">
                         @csrf
                         @method('PATCH')
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
                         <textarea name="content" class="form-control m-2">{{ old('content', $review->content) }}</textarea>
                         <input type="hidden" name="store_id" value="{{$review->store_id}}">
                         <button type="submit" class="btn kadai_002-submit-button ml-2">レビュー内容を編集する</button>
                     </form>
                 </div>
             </div>
             @endauth
@endsection