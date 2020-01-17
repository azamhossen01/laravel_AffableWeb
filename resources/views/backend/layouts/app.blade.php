@include('backend.layouts.header')

  <div id="wrapper">

   @include('backend.layouts.sidebar')

    <div id="content-wrapper">

      @yield('content')

     

@include('backend.layouts.footer')