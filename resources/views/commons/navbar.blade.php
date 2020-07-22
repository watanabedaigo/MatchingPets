<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        
        @if(Auth::guard('admin')->check())
            <a class="navbar-brand" href="/">MatchingPet(管理者ログイン済み)</a>
        @elseif(Auth::guard('web')->check())
            <a class="navbar-brand" href="/">MatchingPet(無料会員ログイン済み)</a>
        @else
            <a class="navbar-brand" href="/">MatchingPet(ログイン未実施)</a>
        @endif        

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::guard('admin')->check())
                    <li class="nav-item">{!! link_to_route('admin.logout', 'ログアウト',[], ['class' => 'nav-link']) !!}</li>
                @elseif(Auth::guard('web')->check())
                    <li class="nav-item">{!! link_to_route('users.favorites', 'お気に入り', ['id' => \Auth::user()->id], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト',[], ['class' => 'nav-link']) !!}</li>
                @else
                    {{-- 無料会員登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', '無料会員登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- 一般ユーザーログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                    {{-- 管理者ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('admin.showlogin', '管理者ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>