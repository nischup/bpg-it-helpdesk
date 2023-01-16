<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts-helpdesk.header')

<body>

<main>

    {{-- @include('frontend.layouts-helpdesk.nav') --}}

    @yield('breadcrumb')

    @yield('content')
    
    @include('frontend.layouts-helpdesk.footer')

    @include('frontend.layouts-helpdesk.scripts')


</main>
    

</body>

</html>