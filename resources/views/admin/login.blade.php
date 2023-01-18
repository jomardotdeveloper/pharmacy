<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Madelyn's Pharmacy - Login</title>
    <link rel="icon" type="image/x-icon" href="/admin/assets/img/rt3.png">
    <!-- Common Styles Starts -->
    <link href="/admin/css2.css?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/structure.css" rel="stylesheet" type="text/css">
    <link href="/admin/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css">
    <link href="/admin/plugins/highlight/styles/monokai-sublime.css" rel="stylesheet" type="text/css">
    <!-- Common Styles Ends -->
    <!-- Common Icon Starts -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Common Icon Ends -->
    <!-- Page Level Plugin/Style Starts -->
    <link href="/admin/assets/css/loader.css" rel="stylesheet" type="text/css">
    <link href="/admin/assets/css/authentication/auth_2.css" rel="stylesheet" type="text/css">
    <!-- Page Level Plugin/Style Ends -->
</head>

<body class="login-two">
    <!-- Loader Starts -->
    <!-- <div id="load_screen">
        <div class="boxes">
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <p class="xato-loader-heading">Xato</p>
    </div> -->
    <!--  Loader Ends -->
    <!-- Main Body Starts -->
    <div class="container-fluid login-two-container">
        <div class="row main-login-two">
            <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block p-0">
                <div class="login-bg">
                    <div class="left-content-area">
                        {{-- <img src="/admin/assets/img/pmg1.jpeg" class="logo"> --}}
                        <div>
                            <h1 class="text-primary">Madelyn's Pharmacy </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                <div class="login-two-start">
                    @if($errors->any())
                    <div class="alert alert-danger mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                        @foreach($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                    @endif
                    <h6 class="right-bar-heading px-3 mt-2 text-dark text-center font-30 text-uppercase">Login</h6>
                    <p class="text-center text-muted mt-1 mb-3 font-14">Please Log into your account</p>
                    <form action="{{ route('login.authenticate') }}" method="POST">
                        @csrf
                        <div class="login-two-inputs mt-5">
                            <input type="text" placeholder="Username" name="username" required />
                            <i class="las la-user-alt"></i>
                        </div>
                        <div class="login-two-inputs mt-4">
                            <input type="password" placeholder="Password" name="password" required />
                            <i class="las la-lock"></i>
                        </div>
                        <div class="login-two-inputs mt-5 text-center d-flex">
                            <button class="ripple-button ripple-button-primary w-100 btn-login ml-3 mr-3" type="submit">
                                <div class="ripple-ripple js-ripple">
                                    <span class="ripple-ripple__circle"></span>
                                </div>
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body Ends -->
    <!-- Page Level Plugin/Script Starts -->
    <script src="/admin/assets/js/loader.js"></script>
    <script src="/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/assets/js/authentication/auth_2.js"></script>
    <!-- Page Level Plugin/Script Ends -->
</body>

</html>