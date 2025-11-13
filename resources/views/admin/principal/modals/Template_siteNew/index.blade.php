<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Coverflow - One Page Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link href="{{ asset('site/css/styleNew.css') }}" rel="stylesheet">
</head>
<body>

    <div class ="row"> 
        @include('Template_siteNew.header')
        </div>

    <div class ="row">
        <section id="about" class="section">
            @yield('content')

        </section>
    </div>

    <div class ="row">
        @include('Template_siteNew.footer')
        <div class="scroll-to-top" id="scrollToTop">
            <span>↑</span>
        </div>
    </div>
 
<script src="{{asset('site/js/scriptNew.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>