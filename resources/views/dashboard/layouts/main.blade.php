<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>{{ $title }}</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  {{-- Bootstrapt icon --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

  {{-- datepicker css --}}
  <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-datepicker.min.css') }}">


  <!-- Custom styles for this template -->
  <link href="/assets/css/dashboard.css" rel="stylesheet">
</head>

<body>
  @include('dashboard.layouts.header')


  <div class="container-fluid">
    <div class="row">

      @include('dashboard.layouts.sidebar')

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-lg-2">
        @yield('content')

      </main>
    </div>
  </div>

  {{-- Jquery --}}
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  {{-- datepicker-id --}}
  <script src="{{ asset('/assets/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/assets/js/bootstrap-datepicker.id.min.js') }}" charset="UTF-8" rtl></script>
  {{-- custom javascript --}}
  <script src="{{ asset('/assets/js/e-absent.js') }}"></script>

  <script src="/assets/js/dashboard.js"></script>
</body>

</html>