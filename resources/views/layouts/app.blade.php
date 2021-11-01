<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- vendor css -->
    <link href="{{ asset('contents/admin') }}/assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('contents/admin') }}/assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('contents/admin') }}/assets/css/starlight.css">
    <style media="screen">
      .signin-logo {
        margin-bottom: 10px;
      }
      .signin-logo span.tx-info {
        font-weight: bold;
      }
    </style>
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      @yield('content')
      <!-- login-wrapper -->
    </div>
    <!-- d-flex -->

    <script src="{{ asset('contents/admin') }}/assets/lib/jquery/jquery.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/popper.js/popper.js"></script>
    <script src="{{ asset('contents/admin') }}/assets/lib/bootstrap/bootstrap.js"></script>

  </body>
</html>
