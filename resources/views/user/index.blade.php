@extends('app')

@section('content')
<div class="row">
    <div class="col"></div>
    <div class="col-auto">
        {!! Form::open(['route' => ['user.export'], 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <button class="btn button"><i class="fa fa-file-excel-o" style="color: green; font-size: large"></i></button>
        {!! Form::close() !!}
    </div>
</div>
@foreach($items as $item)
    <div id="item" class="row card-main mb-4">
        <div class="col mt-auto mb-auto">{{ $item->last_name }} {{ $item->first_name }} {{ $item->middle_name }}</div>

        <div class="col-auto mt-auto mb-auto">
            {!! Form::open(['route' => ['user.show', $item], 'method' => 'get', 'class' => 'form-horizontal']) !!}
            <button class="btn button"><i class="fa-solid fa-angle-right"></i></button>
            {!! Form::close() !!}
        </div>
    </div>
@endforeach

<div class="row">
    {{ $items->links() }}
</div>
@stop

@section('right_bar')
    @can('user.invite')
        <div class="row card-main mb-4" style="max-width: 500px">
            <div class="col-12 mb-3" style="text-align: center; font-weight: normal">Приглашение на регистрацию</div>
            {!! Form::open(['route' => 'user.invite', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'input-form']) !!}

            <div class="form-floating mb-3">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Почта', 'type'=>'email']); !!}
                <label for="floatingInput">Почта</label>
                <div class="invalid-feedback">
                    Введите почту пользователя
                </div>
            </div>

            <div class="mb-3">
                {!! Form::select('role_id', $roles, '', ['id' => 'role', 'class' => 'form-control pt-3 pb-3', 'placeholder' => 'Роль']); !!}
                <div class="invalid-feedback">
                    Выберите роль пользователя
                </div>
            </div>

            <div class="row">
                <div class="col"></div>
                <div class="col-auto">
                    {!! Form::submit('Отправить', ['class' => 'btn btn-primary button mb-2 mr-sm-2', 'style' => 'font-size: 16px;']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        @foreach($invites as $invite)
            <div id="item" class="row card-main mb-4" style="position: relative">
                <div class="col mt-auto mb-auto">{{ $invite->email }}</div>

                @if($invite->send_at)
                    @if($invite->accepted_at)
                        <div class="col-auto mt-auto mb-auto tag" style="position: absolute; top: -15px; right: 12px; background: #3fba5a; border-color: #3fba5a">Принято</div>
                    @else
                        <div class="col-auto mt-auto mb-auto">
                            {!! Form::open(['route' => ['user.invite.delete', $invite], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
                            <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-auto mt-auto mb-auto tag" style="position: absolute; top: -15px; right: 12px; background: #646871; border-color: #646871">Отправлено</div>
                    @endif
                @else
                    @if($invite->accepted_at)
                        <div class="col-auto mt-auto mb-auto tag" style="position: absolute; top: -15px; right: 12px; background: #3fba5a; border-color: #3fba5a">Принято</div>
                    @else
                        <div class="col-auto mt-auto mb-auto">
                            {!! Form::open(['route' => ['user.invite.resend', $invite], 'method' => 'post', 'class' => 'form-horizontal']) !!}
                            <button class="btn btn-outline-warning"><i class="fa fa-refresh"></i></button>
                            {!! Form::close() !!}
                        </div>

                        <div class="col-auto mt-auto mb-auto">
                            {!! Form::open(['route' => ['user.invite.delete', $invite], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
                            <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                            {!! Form::close() !!}
                        </div>

                        <div class="col-auto mt-auto mb-auto tag" style="position: absolute; top: -15px; right: 12px; background: #ba3f3f; border-color: #ba3f3f">Не удалось отправить</div>
                    @endif
                @endif
            </div>
        @endforeach
    @endcan
@stop

@section('footer')
    {{ $items->links() }}
@stop

@section('style')
    <style>
        .tag {
            border: solid 1px;
            border-radius: 10px;
            color: white;
            cursor: default;
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
