@extends('app')

@section('content')
    <div class="row card-main" style="position: relative">
        <div class="row">
            <div class="col" style="position: absolute; left: 0; top: 5px; font-size: large">
                <span>Id:</span>
                <b>{{ $user->id }}</b>
            </div>

            <div class="col-auto" style="position: absolute; right: -10px; top: 0">
                {!! Form::open(['route' => ['user.edit', $user], 'method' => 'get', 'class' => 'form-horizontal']) !!}
                <button class="btn button" style="border: 0"><i class="fa-solid fa-pen"></i></button>
                {!! Form::close() !!}
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
                    {!! Form::text('role', $user->role->title, ['class' => 'form-control', 'disabled', 'style'=>'background: rgb(247, 247, 247)']); !!}
                    <label for="floatingInput">Роль</label>
                </div>
            </div>
        </div>

        <div class="row m-0 mb-4">
            <div class="col">
                <div class="form-floating">
                    {!! Form::text('last_name', $user->last_name, ['class' => 'form-control', 'disabled', 'style'=>'background: rgb(247, 247, 247)']); !!}
                    <label for="floatingInput">Фамилия</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating">
                    {!! Form::text('first_name', $user->first_name, ['class' => 'form-control', 'disabled', 'style'=>'background: rgb(247, 247, 247)']); !!}
                    <label for="floatingInput">Имя</label>
                </div>
            </div>

            <div class="col">
                <div class="form-floating">
                    {!! Form::text('middle_name', $user->middle_name, ['class' => 'form-control', 'disabled', 'style'=>'background: rgb(247, 247, 247)']); !!}
                    <label for="floatingInput">Отчество</label>
                </div>
            </div>
        </div>
    </div>
@stop

@section('right_bar') @stop

@section('style')
    <style>
        .tag-gray {
            border: darkgrey solid 1px;
            border-radius: 10px;
            color: darkgrey;
            cursor: default;
        }
        .tag-gray:hover {
            border: darkgrey solid 1px;
            color: darkgrey;
        }
    </style>
@endsection

@section('js')
    <script>

    </script>
@endsection
