<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Bloom Mush | Admin</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Bloom Mush" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="Bloom Mush"
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->

    @include('layouts.styles')
    
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">


      @include('layouts.header')
      @include('layouts.sidebar')
      @yield('content')
      @include('layouts.footer')


    </div>
    <!--end::App Wrapper-->
    @include('layouts.scripts')
  </body>
  <!--end::Body-->
</html>
