<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Spiders of Balkan Peninsula">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/harpactea.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>BPS</title>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  </head>

  <body>

      <!-- Fixed navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">BP spiders</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="/">Introduction</a></li>
              <li><a href="{{route('guide')}}">User guide</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Taxa <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{route('taxon.search')}}">Search for taxon</a></li>
                  <li><a href="{{route('families')}}">List all families</a></li>
                  <li><a href="{{route('genera')}}">List all genera</a></li>
                  <!-- <li role="separator" class="divider"></li> -->
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistics <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('stat.countries') }}">Localities by country</a></li>
                  <li><a href="{{ route('stat.regions') }}">Localities by region</a></li>
                  <li><a href="{{ route('stat.locality') }}">Species by locality</a></li>
                  <li><a href="{{ route('stat.region') }}">Species by region</a></li>
                  <li><a href="#">Species by country</a></li>
                  <!-- <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li> -->
                </ul>
              </li>
              <li><a href="/literature">Literature</a></li>
              <li><a href="/contact">Contact</a></li>
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
                            <li><a href="{{ route('home') }}">Home</a></li>
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
          </div><!--/.nav-collapse -->
        </div>
      </nav>

      <div class="scroll-top-wrapper">
        <span class="scroll-top-inner">
            <img src="{{ asset('images/spider-scroll.png') }}" class="glyphicon glyphicon-arrow-up" height="60">
        </span>
    </div>

      <div style="margin-bottom: 20px;">@yield('content')</div>
      <br><br>
      <footer class="footer">
        <p class="text-muted" style="text-align: center; margin-top: 20px;">
            <b>Citation:</b> Dimitrov D: Spiders (Araneae) of Balkan Peninsula. online at http://araneae.herokuapp.com. Version {{ date('Y') }}.
          </p>
      </footer>

      <script src="{{ asset('js/app.js') }}"></script>
      {{--<script src="{{ asset('js/maps.js') }}"></script>--}}
      <script>
        (function () {
          'use strict';

          if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style')
            msViewportStyle.appendChild(
              document.createTextNode(
                '@-ms-viewport{width:auto!important}'
              )
            )
            document.querySelector('head').appendChild(msViewportStyle)
          }

          //Active link in menu
          var url = window.location;
          $('.navbar ul.nav li a').filter(function () {
              $('.navbar ul.nav li.active').removeClass('active');
              return this.href == url;
          }).parent().addClass('active');


        })();

        //Scroll top
        $(function(){

            $(document).on( 'scroll', function(){

                if ($(window).scrollTop() > 100) {
                    $('.scroll-top-wrapper').addClass('show');
                    $('#codeprefheader').css('position','fixed').css('top','0px');
                } else {
                    $('.scroll-top-wrapper').removeClass('show');
                    $('#codeprefheader').css('position','relative');
                }
            });

            $('.fancyimg').fancybox({
            openEffect  : 'none',
            closeEffect : 'none',
            type : 'image'
          });

        });

        $(function(){
            $('.scroll-top-wrapper').on('click', scrollToTop);

            var x = parseInt($('.wrapper').first().css('padding-top')) - 15;

            $('a.button.big.scrolly').scrolly({
            bgParallax: true,
            speed: 1000,
            offset: x
            });

        });

      function scrollToTop() {
          verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
          element = $('body');
          offset = element.offset();
          offsetTop = offset.top;
          $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
      }

      //Image dialog
        $('.sp_img').dialog();

      </script>

  </body>
</html>
