<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/app.css') }}">
    <title>Document</title>
</head>

<body>
<div class="row m-2">
    <div class="col"></div>
    <div class="col-md-8 col-sm-12 col-xs-12 card-main mb-4" style="">
        <div class="row">
            <div class="col-12 mb-3 ms-1" style="font-weight: normal; font-size: large">Регистрация в сервисе manageIT</div>
        </div>

        <div class="row">
            <div class="col">
                Ссылка: <a href="{{ route('register.index', 'token='.$invite->token) }}">{{ route('register.index', 'token='.$invite->token) }}</a>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>

</body>

</html>
