<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_NAME') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">Rekognition</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('face_detector') }}">Face Detector</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('face_compare') }}">Face Compare</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('celebrity_recognition') }}">Celebrity Recognition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('text_recognition') }}">Text Recognition</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('object_detection') }}">Object Detection</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-3">
  @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

@yield('js')

</body>

</html>
