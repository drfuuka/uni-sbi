<!DOCTYPE html>
<html lang="en">
  <head>
      <title>@yield('title')</title>
      @include('layouts.includes.head')
      @include('layouts.includes.head-style')
  </head>
<body>

<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">


      <div class="page-content">
        <div class="container-fluid">
          @yield('content')
        </div> <!-- container-fluid -->
      </div>

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
@include('layouts.includes.vendor-scripts')
@yield('scripts')

<script src="{{asset('assets/admin/assets/js/app.js')}}"></script>
</body>
</html>