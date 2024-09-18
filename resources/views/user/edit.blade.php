@extends('app')

@section('content')
    <div class="row card-main" style="position: relative">
        <div class="row">
            <div class="col" style="position: absolute; left: 0; top: 5px; font-size: large">
                <span>Id:</span>
                <b>{{ $user->id }}</b>
            </div>

            <div class="col-auto" style="position: absolute; right: -10px; top: -5px">
                <div class="row">
                    <div class="col pe-0">
                        {!! Form::open(['route' => ['user.show', $user], 'method' => 'get', 'class' => 'form-horizontal']) !!}
                        <button class="btn button button-danger"><i class="icon fas fa-times"></i></button>
                        {!! Form::close() !!}
                    </div>
                    <div class="col ps-0">
                        {!! Form::open(['route' => ['user.update', $user], 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'input-form']) !!}
                        <button class="btn button button-success ps-0"><i class="icon fas fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-0 mt-4 mb-4">
            <div class="col">
                <div class="form-floating">
                    {!! Form::text('email', $user->email, ['class' => 'form-control', 'disabled', 'style'=>'background: rgb(247, 247, 247)']); !!}
                    <label for="floatingInput">Почта</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating">
                    {!! Form::select('role_id', $roles, $user->role_id, ['class' => 'form-control pt-3 pb-3', 'placeholder' => 'Выберите роль', '']); !!}
                </div>
            </div>
        </div>

        <div class="row m-0 mb-4">
            <div class="col">
                <div class="form-floating">
                    {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']); !!}
                    <label for="floatingInput">Фамилия</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating">
                    {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']); !!}
                    <label for="floatingInput">Имя</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating">
                    {!! Form::text('middle_name', $user->middle_name, ['class' => 'form-control']); !!}
                    <label for="floatingInput">Отчество</label>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('right_bar') @stop

@section('style')
    <style>
        .button-success {
            font-size: 20px;
            color: #3fba5a;
            border: 0;
        }

        .button-success:hover{
            color: #247936;
        }

        .button-success:active{
            color: #247936!important;
        }

        .button-danger {
            font-size: 20px;
            color: crimson;
            border: 0;
        }

        .button-danger:hover{
            color: #ba3f3f;
        }

        .button-danger:active{
            color: #ba3f3f!important;
        }


    </style>
@endsection

@section('js')
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
@endsection
