<nav class="navbar navbar-expand-md navbar-light shadow-sm kadai_002-header-container">
   <div class="container">
     <a class="navbar-brand" href="{{ url('/') }}">
       {{ config('app.name', 'NAGOYAMESHI') }}
     </a>
     <form action="{{ route('stores.index') }}" method="GET" class="row g-1">
       <div class="col-auto">
         <input class="form-control kadai_002-header-search-input"  name="keyword">
       </div>
       <div class="col-auto">
         <button type="submit" class="btn kadai_002-header-search-button"><i class="fas fa-search kadai_002-header-search-icon"></i></button>
       </div>
     </form>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
       <span class="navbar-toggler-icon"></span>
     </button>
 
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <!-- Right Side Of Navbar -->
       <ul class="navbar-nav ms-auto mr-5 mt-2">
         <!-- Authentication Links -->
         @guest
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
         </li>
         
         @else
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <label>ログアウト</label>
           </a>
 
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
           </form>
         </li>
         <li class="nav-item mr-5">
          <a class="nav-link" href="{{ route('mypage') }}">
            <i class="fas fa-user mr-1"></i><label>マイページ</label>
          </a>
        </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('mypage.favorite') }}">
             <i class="far fa-heart"></i><label>お気に入り</label>
           </a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('mypage.reservation') }}">
            <label>予約一覧</label>
           </a>
         </li>
         @endguest
         <li class="nav-item mr-5">
          <a class="nav-link" href="{{ route('company') }}">
        </i><label>会社情報</label>
          </a>
           </a>
         </li>
       </ul>
     </div>
   </div>
 </nav>