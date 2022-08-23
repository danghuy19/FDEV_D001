@include('widgets.admin.head')

<body>
<!-- container section start -->
<section id="container" class="">
    
    @include('widgets.admin.header')
    
    @include('widgets.admin.sidebar')
    
    @yield('main-content')
    
</section>
<!-- container section start -->

@include('widgets.admin.footer_script')