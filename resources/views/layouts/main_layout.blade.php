<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>SISTEM PEMBAYARAN SPP</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{ asset('') }}assets/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{ asset('') }}img/user-side.png">

  <!-- style -->
  <link rel="stylesheet" href="{{ asset('') }}assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="{{ asset('') }}assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="{{ asset('') }}assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="{{ asset('') }}assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="{{ asset('') }}assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css -->
  <link rel="stylesheet" href="{{ asset('') }}assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="{{ asset('') }}assets/styles/font.css" type="text/css" />
  <!-- DataTable -->
  <link rel="stylesheet" type="text/css" href="{{ asset('') }}assets/DataTables/datatables.min.css"/>
  <!-- My css -->
  <link rel="stylesheet" href="{{ asset('') }}css/style.css">
  <link rel="stylesheet" href="{{ asset('') }}css/modal.css">
</head>
<body>
  <div class="app" id="app">
    <style>
      .menu-setting {
        opacity: 0;
        display: none;
        padding-top: 10px;
        position: absolute;
        background-color: #FFF;
        box-shadow: 1px 2px 5px rgba(0, 0, 0, .2);
        right: 10px;
        top: 55px;
        text-align: left;
        flex-direction: column;
        border-radius: 3px;
        transition: .5s;
      }
      .menu-setting a {
        color: rgb(79, 79, 79);
        transition: .3s;
        padding: 5px 40px 5px 15px;
      }
      .menu-setting a:last-child {
        margin-top: 8px;
        background-color: #eee;
      }
      .menu-setting a:last-child:hover {
        background-color: #ddd;
      }
      .menu-setting a:hover {
        color: rgb(34, 34, 34);
        background-color: #eee;
      }
    </style>

<!-- ############ LAYOUT START-->

  <!-- sidebar -->
  @include('layouts/sidebar')

  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 box-radius-1x" role="main">

    <!-- navbar -->
    @component('layouts/navbar')

    @endcomponent

    <!-- ############ PAGE START-->
    <div class="row-col b-b">
        <div class="col-md">
            <div class="padding">

                @yield('content')

            </div>
        </div>
    </div>

    <div class="modal fade inactive" id="chat" data-backdrop="false">
    </div>

    <!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / content -->

<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="{{ asset('') }}libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="{{ asset('') }}libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="{{ asset('') }}libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="{{ asset('') }}libs/jquery/underscore/underscore-min.js"></script>
  <script src="{{ asset('') }}libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="{{ asset('') }}libs/jquery/PACE/pace.min.js"></script>

  <script src="{{ asset('') }}scripts/config.lazyload.js"></script>

  <script src="{{ asset('') }}scripts/palette.js"></script>
  <script src="{{ asset('') }}scripts/ui-load.js"></script>
  <script src="{{ asset('') }}scripts/ui-jp.js"></script>
  <script src="{{ asset('') }}scripts/ui-include.js"></script>
  <script src="{{ asset('') }}scripts/ui-device.js"></script>
  <script src="{{ asset('') }}scripts/ui-form.js"></script>
  <script src="{{ asset('') }}scripts/ui-nav.js"></script>
  <script src="{{ asset('') }}scripts/ui-screenfull.js"></script>
  <script src="{{ asset('') }}scripts/ui-scroll-to.js"></script>
  <script src="{{ asset('') }}scripts/ui-toggle-class.js"></script>

  <script src="{{ asset('') }}scripts/app.js"></script>

  <!-- My js -->
  <script src="{{ asset('') }}js/script.js"></script>

  <!-- ajax -->
  <script src="{{ asset('') }}libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="{{ asset('') }}scripts/ajax.js"></script>
  <!-- datatable -->
  <script type="text/javascript" src="{{ asset('') }}assets/DataTables/datatables.min.js"></script>

  <script>
    $('.profile-sett').click(() => {
      var displayMenuProfile = $('.menu-setting').css('display')
      if(displayMenuProfile == 'none') {
        $('.menu-setting').css('display', 'flex')
        setTimeout(function() {
          $('.menu-setting').css('opacity', '1')
        }, 100)
      }else{
        $('.menu-setting').css('opacity', '0')
        setTimeout(function() {
          $('.menu-setting').css('display', 'none')
        }, 500)
      }
    })

    $(document).on('click', function(e) {
      if(e.target.className != 'menu-setting') {
        $('.menu-setting').css('opacity', '0')
        setTimeout(function() {
          $('.menu-setting').css('display', 'none')
        }, 500)
      }
    })

    if($('.app-aside').css('width') > '180px') {
        $('.menu-position').hide();
    }

    setTimeout(function() {
        $('.alert').slideUp('slow')
    }, 3000)
  </script>
<!-- endbuild -->
@yield('scripts')
</body>
</html>
