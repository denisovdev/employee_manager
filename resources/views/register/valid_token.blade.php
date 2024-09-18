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
<div class="row mt-5 m-0 ms-3 me-3">
    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible">
                            <i class="icon fas fa-times"></i> {{ $error }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="col"></div>
    <div class="col-md-6 col-sm-12 col-xs-12 card-main mb-4" style="">
        <div class="col-12 mb-3 ms-1" style="font-weight: normal; font-size: large">Регистрация</div>
        {!! Form::open(['route' => ['register.create', $invite], 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'input-form']) !!}

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    {!! Form::text('email', $invite->email, ['class' => 'form-control', 'placeholder' => 'Почта', 'disabled', 'style' => 'border: 0']); !!}
                    {!! Form::hidden('email', $invite->email) !!}
                    <label for="floatingInput">Почта</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    {!! Form::text('role_id', $invite->role->title, ['class' => 'form-control', 'placeholder' => 'Роль', 'disabled', 'style' => 'border: 0']); !!}
                    {!! Form::hidden('role_id', $invite->role_id) !!}
                    <label for="floatingInput">Роль</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Пароль', 'minlength'=>'8']); !!}
            <label for="floatingInput">Пароль</label>
            <div class="invalid-feedback">
                Введите пароль
            </div>
        </div>

        <div class="form-floating mb-3">
            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Пароль', 'minlength'=>'8']); !!}
            <label for="floatingInput">Пароль</label>
            <div class="invalid-feedback">
                Введите пароль
            </div>
        </div>

        <div class="form-floating mb-3">
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Фамилия']); !!}
            <label for="floatingInput">Фамилия</label>
            <div class="invalid-feedback">
                Введите фамилию
            </div>
        </div>

        <div class="form-floating mb-3">
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Имя']); !!}
            <label for="floatingInput">Имя</label>
            <div class="invalid-feedback">
                Введите имя
            </div>
        </div>

        <div class="form-floating mb-3">
            {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => 'Отчество']); !!}
            <label for="floatingInput">Отчество</label>
            <div class="invalid-feedback">
                Введите отчество
            </div>
        </div>

{{--        <div class="mb-3">--}}
{{--            {!! Form::select('role_id', $roles, '', ['id' => 'role', 'class' => 'form-control pt-3 pb-3', 'placeholder' => 'Роль']); !!}--}}
{{--            <div class="invalid-feedback">--}}
{{--                Выберите роль пользователя--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col"></div>
            <div class="col-auto">
                {!! Form::submit('Отправить', ['class' => 'btn btn-primary button mb-2 mr-sm-2', 'style' => 'font-size: 16px;']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col"></div>
</div>
</body>

<style>
    .img-welcome {
        padding-top: 15%;
        padding-left: 10%;
        width: 100%;
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
