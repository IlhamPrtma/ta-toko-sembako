<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Toko Sembako</title>
        

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

        <nav class="navbar bg-dark ">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <a class="navbar-brand text-white" href="{{ route('informasi.index') }}">Informasi Transaksi Toko</a>
                </ul>
                <ul class="navbar-nav ms-auto ">
                    <a class="nav-link text-white" href="http://127.0.0.1:8000/barang" role="button">Data Barang</a>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <a class="nav-link text-white" href="http://127.0.0.1:8000/pembeli" role="button">Data Pembeli</a>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <a class="nav-link text-white" href="http://127.0.0.1:8000/transaksi" role="button">Data Transaksi</a>
                </ul>
              
            </div>
              


        </nav>

        <div class="container">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>
</html>