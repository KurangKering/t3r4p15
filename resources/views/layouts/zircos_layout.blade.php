
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<link rel="shortcut icon" href="{{ asset('template/zircos/Horizontal-Material/assets/images/favicon.ico') }}">

	<title>Terapi</title>


	<!-- DataTables -->
	<link href="{{ asset('template/zircos/Horizontal-Material/../plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('template/zircos/Horizontal-Material/../plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>


	<!-- App css -->
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('template/zircos/Horizontal-Material/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('template/zircos/Horizontal-Material/../plugins/switchery/switchery.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/zircos/Horizontal-Material/../plugins/switchery/switchery.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/iziModal/css/iziModal.min.css') }}">



	@yield('css')

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/modernizr.min.js') }}"></script>

</head>


<body>


	<!-- Navigation Bar-->
	<header id="topnav">
		<div class="topbar-main">
			<div class="container">

				<!-- Logo container-->
				<div class="logo">
					<!-- Text Logo -->
					<!--<a href="index.html" class="logo">-->
						<!--Zircos-->
						<!--</a>-->
						<!-- Image Logo -->
						<a href="#" class="logo">
							<img src="{{ asset('images/logo-new.png') }}" alt="" width="90" height="70">
						</a>

					</div>
					<!-- End Logo container-->


					<div class="menu-extras">

						<ul class="nav navbar-nav navbar-right pull-right">






							<li class="dropdown navbar-c-items">
								<a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="{{ asset('template/zircos/Horizontal-Material/assets/images/happy.png') }}" alt="user-img" class="img-circle"> </a>
								<ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
									<li class="text-center">
										<h5>Hi, {{ Auth::user()->name }}</h5>
									</li>
									{{-- <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li> --}}
									{{-- <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li> --}}
									{{-- <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li> --}}
									<li><a href="#" 
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-5"></i> Logout</a></li>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
											{!! Form::close() !!}
										</ul>

									</li>
								</ul>
								<div class="menu-item">
									<!-- Mobile menu toggle-->
									<a class="navbar-toggle">
										<div class="lines">
											<span></span>
											<span></span>
											<span></span>
										</div>
									</a>
									<!-- End mobile menu toggle-->
								</div>
							</div>
							<!-- end menu-extras -->

						</div> <!-- end container -->
					</div>
					<!-- end topbar-main -->

					<div class="navbar-custom">
						<div class="container">
							<div id="navigation">
								<!-- Navigation Menu-->
								<ul class="navigation-menu">
                          {{--   <li class="has-submenu">
                                <a href="#"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Dashboard</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="index.html">Dashboard 01</a>
                                    </li>
                                    <li>
                                        <a href="dashboard_2.html">Dashboard 02</a>
                                    </li>
                                </ul>
                            </li> --}}

                            <li>
                            	<a href="{{ url('home') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Dashboard</a>

                            </li>

                            @php
                            $role = Auth::user()->role;
                            @endphp
                            @if($role == 'admin')
                            <li>
                            	<a href="{{ route('klien.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Klien</a>

                            </li>
                            <li>
                            	<a href="{{ route('anak.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Anak</a>

                            </li>
                            <li>
                            	<a href="{{ route('terapis.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Terapis</a>

                            </li>
                            <li>
                            	<a href="{{ route('terapi.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Data Terapi</a>

                            </li>
                            <li>
                            	<a href="{{ route('pengguna.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Pengguna</a>

                            </li>
                            @elseif($role == 'klien')
                            
                            
                            <li>
                                <a href="{{ route('hasil_terapi.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Hasil Terapi</a>

                            </li>
                            <li>
                                <a href="{{ route('hasil_evaluasi.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Hasil Evaluasi</a>

                            </li>
                            @elseif($role == 'terapis')
                            <li>
                            	<a href="{{ route('terapi_anak.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Terapi Anak</a>

                            </li>
                            <li>
                            	<a href="{{ route('hasil_terapi.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Hasil Terapi</a>

                            </li>
                            <li>
                            	<a href="{{ route('hasil_evaluasi.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Hasil Evaluasi</a>

                            </li>
                            @elseif($role == 'pimpinan')
                            <li>
                                <a href="{{ route('pimpinan.daftar_klien') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Daftar Klien</a>

                            </li>
                            <li>
                                <a href="{{ route('pimpinan.daftar_anak') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Daftar Anak</a>

                            </li>
                            {{-- <li>
                                <a href="{{ route('pimpinan.daftar_terapi') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Daftar Terapi</a>

                            </li> --}}
                            <li>
                                <a href="{{ route('pimpinan.daftar_terapis') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Daftar Terapis</a>

                            </li>
                            <li>
                                <a href="{{ route('pimpinan.daftar_terapi_anak') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Terapi Anak</a>

                            </li>
                            <li>
                                <a href="{{ route('pimpinan.daftar_hasil_terapi') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Daftar Hasil Terapi</a>

                            </li>
                            <li>
                                <a href="{{ route('pimpinan.daftar_hasil_evaluasi') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Daftar Hasil Evaluasi</a>

                            </li>
                            
                            
                            @endif

                            @if (in_array($role, ['klien', 'terapis', 'pimpinan']))
                            <li>
                                <a href="{{ route('profil.index') }}"><i class=" mdi mdi-checkbox-blank-circle-outline"></i>Profil</a>

                            </li>

                            @endif

                            
                            
                            
                            
                            
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
        	<div class="container">

        		<!-- Page-Title -->
                {{-- <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li>
                                        <a href="#">Zircos</a>
                                    </li>
                                    <li>
                                        <a href="#">Dashboard</a>
                                    </li>
                                    <li class="active">
                                        Dashboard 2
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">@yield('page-title', 'Page Title')</h4>
                        </div>
                    </div>
                </div> --}}
                @yield('page-title')
                <!-- end page title end breadcrumb -->


                @yield('content')


                <!-- Footer -->
                <footer class="footer text-right">
                	<div class="container">
                		<div class="row">
                			<div class="col-xs-12 text-center">
                				{{-- © 2016. All rights reserved. --}}
                			</div>
                		</div>
                	</div>
                </footer>
                <!-- End Footer -->

            </div>
        </div>


        <!-- jQuery  -->
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/detect.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/jquery.blockUI.js') }}"></script>
        {{-- <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/waves.js') }}"></script> --}}
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/../plugins/switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/axios/dist/axios.min.js') }}"></script>


        <script src="{{ asset('template/zircos/Horizontal-Material/../plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/../plugins/datatables/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('plugins/iziModal/js/iziModal.min.js') }}"></script>





        <!-- App js -->
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('template/zircos/Horizontal-Material/assets/js/jquery.app.js') }}"></script>

        @yield('js')


    </body>
    </html>