<!DOCTYPE html>
<html lang="en" ng-app="monitoringApp">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/cover.css') !!}

    <!-- MetisMenu CSS -->
    {!! Html::style('css/metisMenu.min.css') !!}

    <!-- Timeline CSS -->
    {!! Html::style('css/timeline.css') !!}

    <!-- Custom CSS -->
    {!! Html::style('css/sb-admin-2.css') !!}
    {!! Html::style('css/custom.css') !!}

    <!-- Magic-Check CSS -->
    <link href="css/magic-check.css" rel="stylesheet">
    {!! Html::style('css/magic-check.css') !!}

    <!-- Custom Fonts -->
    {!! Html::style('css/font-awesome.min.css') !!}

    <!-- DatePicker CSS -->
    {!! Html::style('css/bootstrap-datepicker3.min.css') !!}
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Monitoring App</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- Mon profil -->
                <li>
                    <a href="{{route('employe.profil',[Auth::user()->id])}}">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                         {{Auth::user()->nom.' '.Auth::user()->prenom}}
                    </a>
                </li>
                <!-- Déconnexion -->
                <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Déconnexion</a></li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        @if(Auth::user()->id_sup!=0)
                        <li>
                            <a href="{{route('objectif.index')}}"><i class="fa fa-tasks fa-fw"></i> Mes objectif(s)</a>
                        </li>
                        @endif
                        @if(Auth::user()->sup_state==1)
                        <li>
                            <a href="{{route('employe.index')}}"><i class="fa fa-users fa-fw"></i> Mes employé(e)s</a>
                        </li>
                        <li>
                            <a href="{{route('score.index')}}"><i class="fa fa-bar-chart fa-fw"></i> Appréciation(s)</a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard fa-fw"></i> Tableau de bord</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page-header')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- / Content Menu -->
            <div class="row">
                @yield('content-menu')
            </div>
            <!-- / Content -->
            <div class="row">
                @yield('content')
            </div>
            
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Script -->
    <div>
        @yield('script')
    </div>
    <footer>
        @yield('footer')
    </footer>

    <!-- jQuery -->
    {!! HTML::script('js/jquery-1.12.3.js') !!}
    
    <!-- Bootstrap Core JavaScript -->
    {!! HTML::script('js/bootstrap.min.js') !!}

    <!-- Metis Menu Plugin JavaScript -->
    {!! HTML::script('js/metisMenu.min.js') !!}

    <!-- Custom Theme JavaScript -->
    {!! HTML::script('js/sb-admin-2.js') !!}

    <!-- ChartsJS Javascript -->
    {!! HTML::script('js/Chart.min.js') !!}

    <!-- AngularJS core JavaScript
    ================================================== -->
    {!! HTML::script('js/angular.min.js') !!}
    {!! HTML::script('js/app.js') !!}
    {!! HTML::script('js/bootstrap-datepicker.min.js') !!}
    {!! HTML::script('js//locales/bootstrap-datepicker.fr.min.js') !!}
    {!! HTML::script('js/custom-function.js') !!}

</body>

</html>
