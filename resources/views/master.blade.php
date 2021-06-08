  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <title>cashcash</title>

</head>
<body>
    <div class="container" id="app">
        @{{message}}
        @yield('content')
    </div>
</body>
<script src="{{asset("js/app.js")}}"></script>
</html>