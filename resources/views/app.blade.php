<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style/app.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/b7d5720049.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
    <div class="row m-0">
        <div class="col-md-auto col-sm-12 ps-0" style="min-height: 100vh; position: relative">
            @include('sidebar')
        </div>

        <div class="col-md col-sm-12 mt-4 ms-3">
            <div class="row">
                @if (session('success'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible">
                                <i class="icon fas fa-check"></i> {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <i class="icon fas fa-times"></i> {{ $error }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="row">
                <div class="col">
                    @yield('content')

                    <div class="col-12 mt-3">
                        @yield('footer')
                    </div>
                </div>
                <div class="col-auto ps-4 pe-4">
                    @yield('right_bar')
                </div>
            </div>
        </div>
    </div>
</body>

@yield('style')
@yield('js')
</html>
