<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app-modern.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>

</head>

<body class="loading authentication-bg" data-layout-config='{"darkMode":false}'>
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <!-- Logo -->
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="index.html">
                            <span><img src="assets/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">


                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 fw-bold">User Data</h4>
                        </div>
                        @if(session()->has('success'))

                            <div class="alert alert-success" role="alert">
                                <strong>Success - </strong> {{session('success')}}

                            </div>
                        @endif


                        <form method="post" action="{{ route('createUser')}}" autocomplete="off">
                            @csrf


                            <input type="hidden" name="belong_to_gym">
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input class="form-control" type="text" required=""
                                       placeholder="Enter your User Name" name="name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" required=""
                                       placeholder="User email" name="email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input class="form-control" type="number" required=""
                                       placeholder="User Phone" name="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">password</label>
                                <input class="form-control" type="password"
                                       placeholder="User password" name="password">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select class="form-select mb-3" name="type" required>
                                    @if($countUserData == 1)
                                        <option value="superAdmin">Super Admin</option>
                                    @elseif($countUserData == 2)
                                        <option value="admin">Admin</option>
                                    @elseif($countUserData == 3 || $countUserData == 4)
                                        <option value="trainer">Trainer</option>

                                    @else
                                        <option value="">{{"limit full"}}</option>


                                    @endif
                                </select>
                            </div>


                            <hr>
                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Sign Up</button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    <script>document.write(new Date().getFullYear())</script>
    © Fitness Zone
</footer>

<!-- bundle -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/js/app.min.js')}}"></script>

</body>

</html>
