<!DOCTYPE html>
<html>
    <head>
        @include('includes.reg.head')
    </head>
    <body>
        @include('includes.reg.header')
        <div class="wrapper">
            {{ Toastr::render() }}
            @yield('content')
        </div>
        @include('includes.reg.footer')
        <script src="js/bootstrap.min.js"></script>
        <script src="js/app.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>