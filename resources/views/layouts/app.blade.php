<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BG Spiders</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Datatables Buttons extension style -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables_buttons/1.5.6/css/buttons.datatables.min.css') }}">

    <!-- Datatables ColReorder extension style -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables_colreorder/1.5.0/css/colreorder.datatables.min.css') }}">

    <!-- Datatables Fixed Header extension style -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables_fixedheader/3.1.4/css/fixedheader.datatables.css') }}">

    <!-- Datatables Resposive extension style -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables_responsive/2.2.2/css/responsive.datatables.css') }}">

    <!-- Datatables Scroller extension style -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables_scroller/2.0.0/css/scroller.datatables.css') }}">

    <!-- Datatables Select extension style -->
    <link rel="stylesheet" href="{{ asset('vendor/datatables_select/1.3.0/css/select.datatables.css') }}">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:300,400,700|Roboto:400,500,700"> 
    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- config('app.name', 'Laravel') --}}
                        Main
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} {{ Auth::user()->surname }}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @if(Auth::check() && Auth::user()->hasRole('admin'))
                <div class="col-md-2">
                    <nav class="navbar navbar-default sidebar" role="navigation">
                        <div class="container-fluid">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                            <li class="active"><a href="/home">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Authors <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.authors')}}">List</a></li>
                                <li><a href="{{route('admin.authors.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Papers <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-file"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.papers')}}">List</a></li>
                                <li><a href="{{route('admin.papers.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Collections <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.collections')}}">List</a></li>
                                <li><a href="{{route('admin.collections.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Families <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.family')}}">List</a></li>
                                <li><a href="{{route('admin.family.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Genera <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.genus')}}">List</a></li>
                                <li><a href="{{route('admin.genus.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Species <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.species')}}">List</a></li>
                                <li><a href="{{route('admin.species.create')}}">Create</a></li>
                                <li><a href="{{route('admin.species.images')}}">Add image</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Countries <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.country')}}">List</a></li>
                                <li><a href="{{route('admin.country.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Regions <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.region')}}">List</a></li>
                                <li><a href="{{route('admin.region.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Localities <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                                <li><a href="{{route('admin.locality')}}">List</a></li>
                                <li><a href="{{route('admin.locality.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Records <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity"></span></a>
                              <ul class="dropdown-menu forAnimate" role="menu">
                               <li><a href="{{route('admin.record')}}">List</a></li>
                                <li><a href="{{route('admin.record.create')}}">Create</a></li>
                              </ul>
                            </li>
                            <li><a href="{{ route('admin.daily_updates') }}">Daily updates</a></li>
                            <li><a href="{{ route('admin.audit_logs') }}">Audit Logs</a></li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
                <div class="col-md-10">
                @else
                <div class="col-md-12">
                @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <!-- Datatables Buttons extension javascript -->
    <script src="{{ asset('vendor/datatables_buttons/1.5.6/js/datatables.buttons.js') }}"></script>

    <!-- Datatables Buttons html5 extension javascript -->
    <script src="{{ asset('vendor/datatables_buttons/1.5.6/js/buttons.html5.js') }}"></script>

    <!-- Datatables ColReorder extension javascript -->
    <script src="{{ asset('vendor/datatables_colreorder/1.5.0/js/datatables.colreorder.js') }}"></script>

    <!-- Datatables Fixed Header extension javascript -->
    <script src="{{ asset('vendor/datatables_fixedheader/3.1.4/js/datatables.fixedheader.js') }}"></script>

    <!-- Datatables Resposive extension javascript -->
    <script src="{{ asset('vendor/datatables_responsive/2.2.2/js/datatables.responsive.js') }}"></script>

    <!-- Datatables Scroller extension javascript -->
    <script src="{{ asset('vendor/datatables_scroller/2.0.0/js/datatables.scroller.js') }}"></script>

    <!-- Datatables Select extension javascript -->
    <script src="{{ asset('vendor/datatables_select/1.3.0/js/datatables.select.js') }}"></script>    
    
    @yield('admin-scripts')
    <script>
        $('#datepicker').datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            yearRange: '1910:2021'
        });

        (function(){
          $('[data-toggle="tooltip"]').tooltip();
        })();
    </script>
</body>
</html>
