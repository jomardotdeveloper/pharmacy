<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Madelyn's Pharmacy - @yield("title") </title>
    <link rel="icon" type="image/x-icon" href="/admin/assets/img/rt3.png">
    <link href="/admin/css2.css?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/structure.css" rel="stylesheet" type="text/css">
    <link href="/admin/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css">
    <link href="/admin/plugins/highlight/styles/monokai-sublime.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    @yield("custom-styles")
</head>

<body>
    <!--  Navbar Starts  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="#">
                        <img src="/admin/assets/img/rt3.png" style="width:100%;" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="#" class="nav-link" style="margin-left:-.5rem;">Madelyn's Pharmacy</a>
                </li>
            </ul>
            <ul class="navbar-item flex-row ml-md-auto mr-2">
                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle position-relative" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class="las la-bell"></i>
                        @if(count(auth()->user()->notifications) > 0)
                        <div class="blink">
                            <div class="circle"></div>
                        </div>
                        @endif

                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                        <div class="nav-drop is-notification-dropdown">
                            <div class="inner">
                                <div class="nav-drop-header">
                                    <span class="text-black font-12 strong">
                                        @if(count(auth()->user()->notifications) > 0)
                                        {{ count(auth()->user()->notifications) }} Notifications
                                        @else
                                        No notifications
                                        @endif
                                    </span>
                                </div>
                                <div class="nav-drop-body account-items pb-0">
                                    @if(count(auth()->user()->notifications) > 0)
                                    @foreach(auth()->user()->notification_desc as $notification)
                                    <a class="account-item" href="{{route('stocks.index')}}">
                                        <div class="media align-center">
                                            @if($notification->type == "out")
                                            <div class="icon-wrap">
                                                <i class="las la-times font-20"></i>
                                            </div>
                                            @elseif($notification->type == "soon")
                                            <div class="icon-wrap">
                                                <i class="las la-box font-20"></i>
                                            </div>
                                            @else
                                            <div class="icon-wrap">
                                                <i class="las la-calendar-times font-20"></i>
                                            </div>
                                            @endif
                                            <div class="media-content ml-3">
                                                <h6 class="font-13 mb-0 strong">{{ $notification->message }}</h6>
                                                <p class="m-0 mt-1 font-10 text-muted">{{ $notification->time }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    @else
                                    <div class="account-item">
                                        <div class="media align-center">
                                            <div class="icon-wrap">
                                                <i class="las la-folder-open font-20"></i>
                                            </div>
                                            <div class="media-content ml-3">
                                                <h6 class="font-13 mb-0 strong">Empty</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="/admin/assets/img/default.png" alt="avatar">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="nav-drop is-account-dropdown">
                            <div class="inner">
                                <div class="nav-drop-header">
                                    <span class="text-primary font-15">Welcome {{ ucfirst(auth()->user()->role) }} !</span>
                                </div>
                                <div class="nav-drop-body account-items pb-0">
                                    <form action="{{route('logout')}}" method="POST" id="logout">
                                        @csrf
                                        <a class="account-item" id="fakeanchor">
                                            <div class="media align-center">
                                                <div class="icon-wrap">
                                                    <i class="las la-sign-out-alt font-20"></i>
                                                </div>
                                                <div class="media-content ml-3">
                                                    <h6 class="font-13 mb-0 strong ">Logout</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  Navbar Ends  -->
    <!--  Main Container Starts  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <div class="rightbar-overlay"></div>
        <!--  Sidebar Starts  -->
        <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    @if(auth()->user()->role != "cashier")
                    <li class="menu-title">Dashboard</li>
                    <li class="menu">
                        <a href="{{ route('dashboards.dashboard') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'dashboards.dashboard' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-home"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('settings.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'settings.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-sliders-h"></i>
                                <span>Settings</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu-title">Internal</li>
                    <li class="menu">
                        <a href="{{ route('suppliers.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'suppliers.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-warehouse"></i>
                                <span>Suppliers</span>
                            </div>
                        </a>
                    </li>
                    @if(auth()->user()->role == "admin")
                    <li class="menu">
                        <a href="{{ route('users.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'users.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-user"></i>
                                <span>Users</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('taxes.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'taxes.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-money-bill"></i>
                                <span>Taxes</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('discounts.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'discounts.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-money-check-alt"></i>
                                <span>Discounts</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('logs.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'logs.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-book"></i>
                                <span>Logs</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu-title">Products</li>

                    <li class="menu">
                        <a href="{{ route('categories.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'categories.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-layer-group"></i>
                                <span>Category</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('products.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'products.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-box"></i>
                                <span>Products</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    <li class="menu-title">Inventory</li>
                    <li class="menu">
                        <a href="{{ route('stocks.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'stocks.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-boxes"></i>
                                <span>Stocks</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('procurements.index') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'procurements.index' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-industry"></i>
                                <span>Procurement</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->role == "admin" || auth()->user()->role == "cashier")
                    <li class="menu-title">POINT OF SALE</li>
                    <li class="menu">
                        <a href="{{ route('shops.shop') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'shops.shop' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-coins"></i>
                                <span>Shop</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->role == "admin" || auth()->user()->role == "owner")
                    <li class="menu-title">Transactions</li>
                    {{-- <li class="menu">
                        <a href="{{ route('outs.out') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'outs.out' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-file-invoice"></i>
                                <span> Supplier History</span>
                            </div>
                        </a>
                    </li> --}}
                    <li class="menu">
                        <a href="{{ route('sales.sale') }}" aria-expanded="false" class="dropdown-toggle" data-active="{{ request()->route()->getName() == 'sales.sale' ? 'true' : 'false' }}">
                            <div class="">
                                <i class="las la-receipt"></i>
                                <span> Sales History</span>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        <!--  Sidebar Ends  -->
        <!--  Content Area Starts  -->
        <div id="content" class="main-content">
            <!--  Navbar Starts / Breadcrumb Area  -->
            <div class="sub-header-container">
                <header class="header navbar navbar-expand-sm">
                    <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                        <i class="las la-bars"></i>
                    </a>
                    <ul class="navbar-nav flex-row">
                        <li>
                            <div class="page-header">
                                @yield("breadcrumbs")
                            </div>
                        </li>
                    </ul>
                </header>
            </div>
            <!--  Navbar Ends / Breadcrumb Area  -->
            <!-- Main Body Starts -->
            <div class="layout-px-spacing">
                <div class="layout-top-spacing mb-2">
                    <!-- DITO MAGSISIMULA -->
                    @yield("content")
                    <!-- DITO NAMAN MATATAPOS -->
                </div>
            </div>
            <!-- Main Body Ends -->
            <div class="responsive-msg-component">
                <p>
                    <a class="close-msg-component"><i class="las la-times"></i></a>
                    Please reload the page to view the responsive functionalities
                </p>
            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2023 <a target="_blank" href="../index.htm">Madelyn's Pharmacy</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Crafted with extra <i class="las la-heart text-danger"></i></p>
                </div>
            </div>
            <div class="scroll-top-arrow" style="display: none;">
                <i class="las la-angle-up"></i>
            </div>
        </div>
    </div>
    <!-- Main Container Ends -->
    <!-- Common Script Starts -->
    <script src="/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/admin/bootstrap/js/popper.min.js"></script>
    <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/admin/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="/admin/assets/js/custom.js"></script>
    <script>
        $("a#fakeanchor").click(function() {
            $("#logout").submit();
            return false;
        });
    </script>
    @stack("custom-scripts")
</body>

</html>