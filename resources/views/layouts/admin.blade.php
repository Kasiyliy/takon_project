<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Takon</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="stylesheet" href="{{asset("admin/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin/bower_components/font-awesome/css/font-awesome.min.css")}}">

    <link rel="stylesheet" href="{{asset("admin/dist/css/AdminLTE.min.css")}}">
    <link rel="stylesheet" href="{{asset("admin/dist/css/skins/_all-skins.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/jquery.select.css")}}">
    <link rel="stylesheet" href="{{asset("css/mapbox.css")}}">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
          href="{{asset("admin/bower_components/datatable/css/dataTables.bootstrap.min.css")}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset("admin/bower_components/datatable/css/responsive.bootstrap.min.css")}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset("admin/bower_components/datatable/css/scroller.bootstrap.min.css")}}"/>
    <link rel="stylesheet" type="text/css"
          href="{{asset("admin/bower_components/daterangepicker/daterangepicker.css")}}"/>
    <link href="{{asset("admin/bower_components/select2/select2.css")}}"
          el="stylesheet"/>
    <style>
        .panel {
            padding: 10px;
        }

    </style>
    @yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a class="logo">
            <span class="logo-mini"><b>T</b>APP</span>
            <span class="logo-lg"><b>Takon</b>APP</span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user-circle" style="color:white"></i>
                            <span class="hidden-xs">{{Auth::user()->username}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <i class="fa fa-home fa-3x" style="color:white"></i>
                                <p>
                                    {{Auth::user()->first_name. ' '. Auth::user()->last_name}}
                                </p>
                            </li>
                            <li class="user-footer">
                                {{--<div class="pull-left">--}}
                                {{--<a href="{{route('self.user.edit')}}"--}}
                                {{--class="btn btn-default btn-flat">{{trans('admin.profile')}}</a>--}}
                                {{--</div>--}}

                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выход
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left text-white">
                    <i class="fa fa-user-circle fa-2x " style="color:white"></i>
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->username}}</p>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Главная</li>
                <li>
                    <a href="{{route('home')}}">
                        <i class="fa fa-home"></i> <span>Главная</span>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())

                    <li class="header">Администраторская панель</li>

                    <li class="treeview" style="height: auto;">
                        <a href="#">
                            <i class="fa fa-users"></i> <span>Пользователи</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu" style="">
                            <li>
                                <a href="{{route('user.admins')}}"><i class="fa fa-circle-o"></i>Админы</a>
                            </li>
                            <li>
                                <a href="{{route('user.companies')}}"><i class="fa fa-circle-o"></i>Компании</a>
                            </li>
                            <li>
                                <a href="{{route('user.partners')}}"><i class="fa fa-circle-o"></i>Партнеры</a>
                            </li>
                            <li>
                                <a href="{{route('user.mobileUsers')}}"><i class="fa fa-circle-o"></i>Мобильные
                                    пользователи</a>
                            </li>
                            <li>
                                <a href="{{route('user.cashiers')}}"><i class="fa fa-circle-o"></i>Продавцы</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="{{route('user.services')}}">
                            <i class="fa fa-check-circle"></i> <span>Модерация сервисов </span>
                            @if(session()->get('moderationCount'))
                                <span class="badge">{{session()->get('moderationCount')}}</span>
                            @endif
                        </a>
                    </li>


                    <li class="header">Настройки</li>

                    <li>
                        <a href="{{route('role.index')}}">
                            <i class="fa fa-gears"></i> <span>Роли</span>
                        </a>
                    </li>

                @elseif(\Illuminate\Support\Facades\Auth::user()->isCompanyJM())
                    <li class="header">Компания/Юридическое лицо</li>
                    <li>
                        <a href="{{route('company.mobileUsers')}}">
                            <i class="fa fa-phone"></i>
                            <span>Мобильные пользователи</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('company.groups')}}">
                            <i class="fa fa-group"></i>
                            <span>Группы</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('company.services.orders')}}">
                            <i class="fa fa-share"></i>
                            <span>
                                Раздать сервисы
                            </span>
                        </a>
                    </li>
                    <li class="treeview" style="height: auto;">
                        <a href="#">
                            <i class="fa fa-product-hunt"></i> <span>Услуги</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                        </a>
                        <ul class="treeview-menu" style="">
                            <li>
                                <a href="{{route('company.services')}}"><i class="fa fa-circle-o"></i>Просмотр услуг</a>
                            </li>
                            <li>
                                <a href="{{route('company.orders.history')}}"><i class="fa fa-circle-o"></i>История
                                    заказов</a>
                            </li>
                        </ul>
                    </li>
                @elseif(\Illuminate\Support\Facades\Auth::user()->isPartner())
                    <li class="header">Партнер</li>
                    <li>
                        <a href="{{route('partner.services')}}">
                            <i class="fa fa-server"></i>
                            <span>Услуги</span>
                            @if(session()->get('moderationCount'))
                                <span class="badge">{{session()->get('moderationCount')}}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{route('partner.cashiers')}}"><i class="fa fa-shopping-cart"></i>Продавцы</a>
                    </li>
                    <li class="treeview" style="height: auto;">
                        <a href="#">
                            <i class="fa fa-product-hunt"></i> <span>Заказы</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                                @if(session()->get('ordersCount'))
                                    <span class="badge">{{session()->get('ordersCount')}}</span>
                                @endif
                    </span>
                        </a>
                        <ul class="treeview-menu" style="">
                            <li>
                                <a href="{{route('partner.services.orders')}}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Заказы в ожидании</span>
                                    @if(session()->get('ordersCount'))
                                        <span class="badge">{{session()->get('ordersCount')}}</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{route('partner.services.ordersRejected')}}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Отказанные заказы</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('partner.services.ordersAccepted')}}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Принятые заказы</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @elseif(\Illuminate\Support\Facades\Auth::user()->isMobileUser())
                    <li class="header">Мобильный пользователь</li>
                    <li>
                        <a href="{{route('mobileUser.account.company.order')}}">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Мои сервисы</span>
                        </a>
                    </li>
                @elseif(\Illuminate\Support\Facades\Auth::user()->isCashier())
                    <li class="header">Продавец</li>
                @endif
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content">

            @yield('content')

        </section>
    </div>
    <footer class="main-footer">
        Все права защищены {{date('Y')}}. Takon
    </footer>
</div>


<script src="{{asset("admin/bower_components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("admin/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/jquery.select.js")}}"></script>
<script src="{{asset("js/number.divider.js")}}"></script>
<script src="{{asset("admin/dist/js/adminlte.min.js")}}"></script>
<script src="{{asset('js/toastr.js')}}"></script>
<script src="{{asset('js/bootbox.all.min.js')}}"></script>

<script type="text/javascript" src="{{asset("admin/bower_components/datatable/js/jquery.datatables.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/datatable/js/dataTables.bootstrap.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/datatable/js/dataTables.responsive.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/datatable/js/responsive.bootstrap.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/datatable/js/dataTables.scroller.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/datatable/js/dataTables.fixed-header.min.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/datatable/js/datatable.sum.js")}}"></script>

<script type="text/javascript"
        src="{{asset("admin/bower_components/daterangepicker/moment.js")}}"></script>
<script type="text/javascript"
        src="{{asset("admin/bower_components/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{asset("admin/bower_components/select2/select2.js")}}"></script>
<script src="{{asset('js/mapbox.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('datatable')

<script>
    toastr.options.closeButton = true;
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif

    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif

    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}");
    @endif

    @if(Session::has('warning'))
    toastr.info("{{Session::get('warning')}}");
    @endif

</script>
@yield('scripts')
</body>
</html>
