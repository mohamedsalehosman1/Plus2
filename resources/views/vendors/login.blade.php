<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <title>تسجيل دخول البائع</title>
    <!-- Icons -->
    <link href="{{ asset('assets2/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('assets2/dest/style.css') }}" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                            style="width: 185px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">We are The Vendors Team</h4>
                                        </div>

                                    <form action="{{ route('vendors.login') }}" method="POST" class="signin-form">
                                        @csrf
                                        <p>من فضلك سجل الدخول كـ بائع</p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="form2Example11" name="email"
                                                class="form-control" placeholder="البريد الإلكتروني" required />
                                            <label class="form-label" for="form2Example11">البريد الإلكتروني</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="form2Example22" name="password"
                                                class="form-control" required />
                                            <label class="form-label" for="form2Example22">كلمة المرور</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">تسجيل الدخول</button>
                                        </div>

                                       <div class="text-center">
                                            <a class="text-muted" href="#" data-toggle="modal"
                                                data-target="#resetPasswordModal">نسيت كلمة المرور؟</a>
                                        </div>

                                    </form>

                                    <div class="text-center">
                                        <a class="text-muted" href="{{ route('login.show') }}">Login AS
                                            Admin</a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('assets2/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('assets2/js/libs/bootstrap.min.js') }}"></script>
</body>

</html>
