<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts.header')

<body>

<main>

    @include('frontend.layouts.nav')

    @yield('breadcrumb')

    @yield('content')
    
    @include('frontend.layouts.footer')

    @include('frontend.layouts.scripts')


</main>
    

</body>

</html>