<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <title>إعادة تعيين كلمة المرور</title>
    <!-- Icons -->
    <link href="{{ asset('assets2/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets2/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('assets2/dest/style.css') }}" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <h4 class="mt-1 mb-5 pb-1">استعادة كلمة المرور</h4>
                                    </div>

                                    <form action="{{ route('password.email') }}" method="POST">
                                        @csrf
                                        <p>من فضلك أدخل البريد الإلكتروني الخاص بحسابك لإرسال رابط استعادة كلمة المرور.
                                        </p>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control" required
                                                placeholder="البريد الإلكتروني">
                                            <label class="form-label" for="email">البريد الإلكتروني</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">إرسال رابط الاستعادة</button>
                                        </div>

                                        <div class="text-center">
                                            <a class="text-muted" href="{{ route('login') }}">رجوع إلى صفحة تسجيل
                                                الدخول</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets2/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('assets2/js/libs/bootstrap.min.js') }}"></script>
</body>

</html>
