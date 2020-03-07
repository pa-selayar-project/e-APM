<!DOCTYPE html>
<html>

<head>
  @include('layouts.header')

  <title>@yield('title')</title>
  @yield('stylesheet')
</head>

<body class="widescreen fixed-left-void">
  <div id="wrapper" class="enlarged forced">
    @include('layouts.topbar')

    @include('layouts.left')

    <div class="content-page">
      <!-- Start content -->
      <div class="content">
        <div class="container">
          @include('layouts.title')
          @yield('content')
        </div> <!-- container -->
      </div> <!-- content -->
      <footer class="footer text-right">
        <span class="pull-right m-r-15">© 2019. Register Kepegawaian PA Selayar.</span>
      </footer>
    </div>
  </div>

  @include('layouts.footer')

</body>

</html>