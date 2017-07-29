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
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/jquery-ui.min.css" rel="stylesheet">

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
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::user()->hasRole('admin'))
                                        <li><a href="/admin/authors">Admini panel</a></li>
                                    @endif
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
                @if(Auth::check())
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
                            <!-- <li ><a href="#">Libros<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>        
                            <li ><a href="#">Tags<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li> -->
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

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        $('#datepicker').datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            yearRange: '1915:2027'
        });
    </script>
</body>
</html>
