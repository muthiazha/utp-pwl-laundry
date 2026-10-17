<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #eef6fb;">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-primary">@yield('code')</h1>
        <p class="fs-5 mb-4">@yield('message')</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>