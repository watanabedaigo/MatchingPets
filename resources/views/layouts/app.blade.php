<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>MatchingPets</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="{{asset('/css/stylesheet.css')}}" rel="stylesheet">
        <link href="{{asset('/css/responsive.css')}}" rel="stylesheet">
    </head>

    <body>
        @include('commons.navbar')

        <div class="container" id="background" style="background-color:linen;">
            @include('commons.error_messages')
            @yield('content')
        </div>
        
        <!--ここにヘッダーをincludeする。-->
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ asset('/js/main.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>