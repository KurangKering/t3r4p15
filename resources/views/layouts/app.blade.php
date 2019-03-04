<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Neon Admin Panel" />
    <meta name="author" content="" />
    <link rel="icon" href="{{ asset('template/backend/assets/images/favicon.ico') }}">
    <title>#</title>
    <link rel="stylesheet" href="{{ asset('template/backend/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/font-icons/entypo/css/entypo.css') }}">
    {{-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic"> --}}
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/neon-forms.css') }}">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/css/skins/black.css') }}">

    <script src="{{ asset('template/backend/assets/js/jquery-1.11.3.min.js') }}"></script>
    <!--[if lt IE 9]><script src="{{ asset('template/backend/assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-body skin-black page-left-in">
    <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <div class="sidebar-menu">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{ asset('template/backend/assets/images/logo@2x.png') }}" width="120" alt="" />
                        </a>
                    </div>
                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                </header>
                <div class="sidebar-user-info">
                    <div class="sui-normal">
                        <a href="#" class="user-link">
                            <img src="{{ asset('template/backend/assets/images/thumb-1@2x.png') }}" width="55" alt="" class="img-circle" />
                            <span>Welcome,</span>
                            <strong>Art Ramadani</strong>
                        </a>
                    </div>
                    <div class="sui-hover inline-links animate-in"><!-- You can remove "inline-links" class to make links appear vertically, class "animate-in" will make A elements animateable when click on user profile -->
                        <a href="#">
                            <i class="entypo-lock"></i>
                            Log Off
                        </a>
                        <span class="close-sui-popup">&times;</span><!-- this is mandatory -->              </div>
                    </div>
                    <ul id="main-menu" class="main-menu">
                        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                        
                        <li>
                            <a href="{{ url('home') }}">
                                <i class="entypo-monitor"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('klien.index') }}">
                                <i class="entypo-monitor"></i>
                                <span class="title">Klien</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('anak.index') }}">
                                <i class="entypo-monitor"></i>
                                <span class="title">Anak</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terapis.index') }}">
                                <i class="entypo-monitor"></i>
                                <span class="title">Terapis</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('terapi.index') }}">
                                <i class="entypo-monitor"></i>
                                <span class="title">Data Terapi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengguna.index') }}">
                                <i class="entypo-monitor"></i>
                                <span class="title">Pengguna</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="main-content">
                <div class="row">
                    <!-- Profile Info and Notifications -->
                    <div class="col-md-6 col-sm-8 clearfix">
                    </div>
                    <!-- Raw Links -->
                    <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                        <ul class="list-inline links-list pull-right">

                            <li>
                                <a href="#" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Log Out <i class="entypo-logout right"></i>
                            </a>



                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            {!! Form::close() !!}
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            @yield('page-title','PAGE TITLE')
            <br />

            <div class="pull-right">
            </div>
            @yield('content', 'CONTENT')

            <!-- Footer -->
            <footer class="main">
            </footer>
        </div>
    </div>
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="{{ asset('template/backend/assets/js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" href="{{ asset('template/backend/assets/js/rickshaw/rickshaw.min.css') }}">

    @yield('css')

    <!-- Bottom scripts (common) -->
    <script src="{{ asset('template/backend/assets/js/gsap/TweenMax.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/joinable.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/resizeable.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/neon-api.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <!-- Imported scripts on this page -->
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/rickshaw/vendor/d3.v3.js') }}"></script>
    <script src="{{ asset('template/backend/assets/js/rickshaw/rickshaw.min.js') }}"></script>

    @yield('js')

    <!-- JavaScripts initializations and stuff -->
    <script src="{{ asset('template/backend/assets/js/neon-custom.js') }}"></script>
    <!-- Demo Settings -->
    <script src="{{ asset('template/backend/assets/js/neon-demo.js') }}"></script>


</body>
</html>