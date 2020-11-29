<header>
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:darkseagreen;"> <!--color候補　mediumseagreen-->
        <a class="navbar-brand" href="/">MatchingPet</a>
        
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar" style="width:200px">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::guard('admin')->check())
                    <li class="nav-item mr-2">{!! link_to_route('index','データ追加',[],['class' => 'nav-link rounded text-dark btn-bg']) !!}</li>
                    <li class="nav-item ">{!! link_to_route('admin.logout', 'ログアウト',[], ['class' => 'nav-link rounded text-dark btn-bg']) !!}</li>
                @elseif(Auth::guard('web')->check())
                    <li class="nav-item mr-2">{!! link_to_route('users.favorites', 'お気に入り', ['id' => \Auth::user()->id], ['class' => 'nav-link rounded text-dark btn-bg']) !!}</li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト',[], ['class' => 'nav-link rounded text-dark btn-bg']) !!}</li>
                @else
                    {{-- 無料会員登録ページへのリンク --}}
                    <li class="nav-item mr-2">{!! link_to_route('signup.get', '無料会員登録', [], ['class' => 'nav-link rounded text-dark btn-bg']) !!}</li>
                    {{-- 一般ユーザーログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link rounded text-dark btn-bg']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>