<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('layouts.head');

</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                @include('layouts.header')


                @include('layouts.sidebar')


                <div class="section-content-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer-scripts');

</body>

</html>
