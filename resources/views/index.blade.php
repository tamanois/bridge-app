<!doctype html>
<html lang="{{\Illuminate\Support\Facades\App::getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{isset($title)? $title : 'Bridge - app'}}</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.js')}}"></script>
    @yield('styles')
</head>
<body>
<div id="header" class="pt-2">
    <h1 style="color: white">Bridge - app</h1>
</div>

<div class="container" style="padding-top: 25px">
    @yield('content')

    <div class="row mt-5" style="text-align: center">
        <span id="btn_logout" class="btn btn-danger" style="text-align: center"><h5 >Logout</h5></span>
    </div>
</div>


    <script>
        $('#btn_logout').on('click', function () {
            $.ajax({
                url:'{{route('logout')}}',
                method:'POST',
                data:'_token=' + '{{csrf_token()}}',
                success: function () {
                    location.href = '{{route('index')}}';
                },
                error: function () {
                    location.href = '{{route('index')}}';

                }

            });
        });
    </script>
    @yield('scripts')
</body>
</html>