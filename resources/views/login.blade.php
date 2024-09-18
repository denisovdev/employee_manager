<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/app.css') }}">
    <title>manageAPP</title>
</head>

<body>
    <div class="row m-0">
        <div class="col-md-6 col-sm-12">
            <img src="src/bg.png" class="img-welcome">
        </div>

        <div class="col-md-6 col-sm-12 ps-5" style="margin-top: 15%">
            {{-- <div class="row">
                <span style="font-size: 36px; color: #3D4150">Добро пожаловать</span><br>
                <span style="font-size: 36px; font-weight: 200; color: #7a7d82">-<br></span>
            </div> --}}

            <div class="row mt-5 pe-5">

                <div class="col-xl-9 col-md-12 col-sm-12 mb-5 pt-4 pb-4 ps-5 pe-5 card">

                    <form action="{{ route('login') }}" method="post" id="input-form">
                        @csrf
                        <div class="row mb-3">
                            <span style="font-size: 36px; color: #3D4150">Вход</span>
                        </div>

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

                        @if (session('success'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible">
                                        <i class="icon fas fa-check"></i> {{ session('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="email" placeholder="name@example.com" name="email">
                            <label for="floatingInput">Почта</label>
                            <div class="invalid-feedback">
                                Введите почту
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="name@example.com" name="password">
                            <label for="floatingInput">Пароль</label>
                            <div class="invalid-feedback">
                                Введите пароль
                            </div>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Оставаться в системе</label>
                        </div>

                        <div class="row">
                            <div class="col"></div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn btn-outline-dark ps-5 pe-5">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    .img-welcome {
        padding-top: 10%;
        padding-left: 10%;
        width: 90%;
        height: 100%;
    }
</style>

<script>
    var form = document.getElementById('input-form')
    var inputs = document.querySelectorAll('.form-control')

    const validate = () => {
        var is_valid = true;

        inputs.forEach(function (input) {
            if (input.value.trim() === '') {
                is_valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        })

        return is_valid;
    }

    form.addEventListener('submit', function (event) {
        if (!validate()) {
            event.preventDefault();
        }
    })

</script>

</html>
