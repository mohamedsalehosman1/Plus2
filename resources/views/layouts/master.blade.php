<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>SurfsideMedia</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    @include('layouts.header')
</head>

<body class="body">
    <div id="wrapper">
        <div id="page">
            <div class="layout-wrap">
                @include('layouts.head')

                {{-- Uncomment the following lines if you want to include a preloader
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                --}}

                @include('layouts.sidebar')

                <!-- Main Content Section -->
                <div class="section-content-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    @include('layouts.footer-scripts')
</body>

</html>
