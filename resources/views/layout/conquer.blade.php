<!DOCTYPE html>
<!--
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Sistem Informasi UD Farm Lestari')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('assets/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/select2.css')}}" />
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css')}}" />
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css')}}" />
    <link rel="stylesheet" type="text/css"
        {{-- href="{{asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" /> --}} <!-- END PAGE
        LEVEL PLUGIN STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{asset('assets/css/style-conquer.cs')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages/tasks.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('assets/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css')}}" />
    {{-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js">
    </script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css"> -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="header-inner">
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <img src="{{asset('assets/img/menu-toggler.png')}}" alt="" />
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN TODO DROPDOWN -->
                <!-- END TODO DROPDOWN -->
                <li class="devider">
                    &nbsp;
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                        data-close-others="true">
                        <img alt="" src="{{asset('assets/img/avatar3_small.jpg')}}" />
                        <span class="username username-hide-on-mobile">
                            @if (Auth::user())
                            {{ Auth::user()->nama }}
                            @endif
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            @if (Auth::user())
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                <input type="submit" value="Log Out">
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            @endif
                            <!-- <a href="{{ route('login') }}"><i class="fa fa-key"></i> Log Out</a> -->

                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
                <ul class="page-sidebar-menu">
                    <li class="sidebar-toggler-wrapper">
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler">
                        </div>
                        <div class="clearfix">
                        </div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    </li>

                    <li class="start active ">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home"></i>
                            <span class="title">Dashboard</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" icon-folder"></i>
                            <span class="title">Master Data</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('barang.index') }}">Barang
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('flok.index') }}">Flok Ayam
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('supplier.index') }}">Supplier
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.index') }}">Customer
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('jabatan.index') }}">Jabatan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.index') }}">Pengguna
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akun.index') }}">Akun
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" icon-briefcase"></i>
                            <span class="title">Transaksi</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a href="{{ route('nota.index') }}">Tambah Nota
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('notapemesanan.index') }}">Nota Pemesanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('notapembelian.index') }}">Nota Pembelian
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('notapenjualan.index') }}">Nota Penjualan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pemasukantelur.index') }}">Pemasukan Telur
                                </a>
                            </li>
                            <li>

                                <a href="{{ route('jadwalpakan.index') }}">Pemberian Pakan
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" icon-calendar"></i>
                            <span class="title">Produksi</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a href="{{ route('bom.index') }}">Bill of Material
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('spk.index') }}">Surat Perintah Kerja
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mps.index') }}">Master Production Schedule
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mrp.index') }}">Material Requirement Planning
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mrp.laporanKebutuhan') }}">Kebutuhan Bahan Baku
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lpb.index') }}">Laporan Pengeluaran Barang
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('hasilproduksi.index') }}">Daftar Hasil Produksi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('suratjalan.index') }}">Surat Jalan
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class=" icon-bar-chart"></i>
                            <span class="title">Laporan Keuangan</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a href="{{ route('aruskas.index') }}">
                                    <span class="title">Laporan Akuntansi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('akun.index') }}" class="title">Akun
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('jurnal_akuntansi.create') }}" class="title">Tambah Jurnal
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('jurnal_akuntansi.index') }}">
                                    <span class="title">Jurnal</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bukubesar.index') }}">
                                    <span class="title">Buku Besar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('labarugi.index') }}">
                                    <span class="title">Laporan Laba Rugi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('perubahanekuitas.index') }}">
                                    <span class="title">Laporan Perubahan Ekuitas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('neraca.index') }}">
                                    <span class="title">Laporan Neraca</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('aruskas.index') }}">
                                    <span class="title">Laporan Arus Kas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('periode_akuntansi.index') }}">
                                    <span class="title">Penutupan Periode</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
                @endif
                @yield('content')

            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            Sistem Informasi UD Farm Lestari
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('assets/plugins/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"
        type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('assets/plugins/jquery.peity.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-knob/js/jquery.knob.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}">
    </script>
    <script type="text/javascript"
        src="{{asset('assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}">
    </script>
    <script type="text/javascript"
        src="{{asset('assets/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}">
    </script>
    <script type="text/javascript"
        src="{{asset('assets/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js')}}">
    </script>
    <script type="text/javascript"
        src="{{asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <script src="{{asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript">
    </script>
    <script src="{{asset('assets/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/scripts/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/index.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/scripts/tasks.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.editable.min.js') }}" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('assets/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js')}}">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
    <script src="{{ asset('assets/scripts/app.js') }}"></script>
    <script src="{{ asset('assets/scripts/table-advanced.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            App.init();
            TableAdvanced.init();
        });

    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function () {
            App.init(); // initlayout and core plugins
            Index.init();
            Index.initJQVMAP(); // init index page's custom scripts
            Index.initCalendar(); // init index page's custom scripts
            Index.initCharts(); // init index page's custom scripts
            Index.initChat();
            Index.initMiniCharts();
            Index.initPeityElements();
            Index.initKnowElements();
            Index.initDashboardDaterange();
            Tasks.initDashboardWidget();
        });

    </script>
    @yield('javascript')
    @yield('initialscript')
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
