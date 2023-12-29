<!DOCTYPE html>
<html lang="vi">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NZR2982K');</script>
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7NNEWTZNLS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-7NNEWTZNLS');
</script>
<!-- End Google Tag Manager -->
        <!-- Load css -->
        <link rel="stylesheet" type="text/css" href="<?= asset('css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/bootstrap.min.css.map') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/style.css.map') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/style.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/style.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/owl.carousel.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/owl.theme.default.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?= asset('css/owl.theme.green.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= asset('css/ion.rangeSlider.min.css') ?>" />
        <link  rel="stylesheet" type="text/css" href="<?= asset('css/hover.css') ?>">

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?= asset('js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?= asset('js/bootstrap.bundle.min.js') ?>"></script>
        <script type="text/javascript" src="<?= asset('js/owl.carousel.min.js') ?>"></script>
        <script type="text/javascript" src="<?= asset('js/jquery-ui.min.js') ?>"></script>
        <script type="text/javascript" src="<?= asset('js/ion.rangeSlider.min.js') ?>"></script>
        <script type="text/javascript" src="<?= asset('js/script.js') ?>"></script>

    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NZR2982K"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        @component('elements.header')@endcomponent
        
        @yield('content')

        @component('elements.footer')@endcomponent
        <!-- Load js -->
    </body>
</html>