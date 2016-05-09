<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitoring App</title>

    <!-- Fonts -->
    {!! Html::style('css/font-awesome.min.css') !!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    {!! Html::style('css/bootstrap.min.css') !!}

    <style>
        body {
            
        }

        .fa-btn {
            margin-right: 6px;
        }
        #log-form-container{
            margin-top:40px;
        }
    </style>
</head>
<body id="app-layout">
    

    @yield('content')

   <!-- jQuery -->
   {!! HTML::script('js/jquery-1.12.3.js') !!}
   
   <!-- Bootstrap Core JavaScript -->
   {!! HTML::script('js/bootstrap.min.js') !!}

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
