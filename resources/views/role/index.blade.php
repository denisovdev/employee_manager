@extends('app')

@section('content')
    @foreach($items as $item)
        <div id="item" class="row card-main mb-4">
            <div class="col mt-auto mb-auto">{{ $item->title }}</div>

            @if($item->code != $item::ADMIN)
            <div id="delete" class="col-auto mt-auto mb-auto" style="opacity: 0">
                {!! Form::open(['route' => ['role.delete', $item], 'method' => 'delete', 'class' => 'form-horizontal']) !!}
                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                {!! Form::close() !!}
            </div>
            @endif

            <div class="col-auto mt-auto mb-auto">
                {!! Form::open(['route' => ['role.show', $item], 'method' => 'get', 'class' => 'form-horizontal']) !!}
                <button class="btn button"><i class="fa-solid fa-angle-right"></i></button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
@stop

@section('right_bar')
    <div class="row card-main" style="max-width: 400px">
        <div class="col-12 mb-3" style="text-align: center; font-weight: normal">Создание роли</div>
        {!! Form::open(['route' => 'role.create', 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'input-form']) !!}

        <div class="form-floating mb-3">
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Код']); !!}
            <label for="floatingInput">Код</label>
            <div class="invalid-feedback">
                Введите код роли
            </div>
        </div>

        <div class="form-floating mb-3">
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Код']); !!}
            <label for="floatingInput">Название</label>
            <div class="invalid-feedback">
                Введите название роли
            </div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-auto">
                {!! Form::submit('Создать', ['class' => 'btn btn-primary button mb-2 mr-sm-2', 'style' => 'font-size: 16px;']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('footer')
    {{ $items->links() }}
@stop

@section('style')
    <style>
        /*.button {*/
        /*    !*font-size: 20px;*!*/
        /*    background: #6875FE;*/
        /*    border-radius: 5px;*/
        /*    color: white;*/
        /*    transition: background 0.2s;*/
        /*}*/

        /*.button:hover {*/
        /*    background: #252a70;*/
        /*    cursor: pointer;*/
        /*    color: white;*/
        /*}*/
    </style>
@endsection

@section('js')
    <script>
        let items = document.querySelectorAll("#item");

        Array.from(items).forEach(item => {
            item.addEventListener('mousemove', async function(event) {
                item.childNodes.forEach(child => {
                    if (child.id === 'delete') {
                        child.style.opacity = "1";
                    }
                });
            });
            item.addEventListener('mouseout', function(event) {
                item.childNodes.forEach(child => {
                    if (child.id === 'delete') {
                        child.style.opacity = "0";
                    }
                });
            });
        });

        let form = document.getElementById('input-form');
        let inputs = document.querySelectorAll('.form-control');

        const validate = () => {
            let is_valid = true;

            inputs.forEach(function (input) {
                if (input.value.trim() === '') {
                    is_valid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            return is_valid;
        }

        form.addEventListener('submit', function (event) {
            if (!validate()) {
                event.preventDefault();
            }
        });

    </script>
@endsection
