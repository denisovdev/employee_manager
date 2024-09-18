@extends('app')

@section('content')
    <div class="row">
        <div class="col card-main">
            <div class="form-floating mb-3 mt-3">
                {!! Form::text('id', $item->id, ['class' => 'form-control', 'disabled'=>true]); !!}
                <label for="floatingInput">Id</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                {!! Form::text('code', $item->code, ['class' => 'form-control', 'disabled'=>true]); !!}
                <label for="floatingInput">Код</label>
            </div>

            <div class="form-floating mb-3">
                {!! Form::text('title', $item->title, ['class' => 'form-control', 'disabled'=>true]); !!}
                <label for="floatingInput">Название</label>
            </div>
        </div>
    </div>
@stop

@section('right_bar')
    {!! Form::open(['route' => ['role.right.update', $item], 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'input-form', 'style'=>'max-width: 400px;']) !!}
    <div class="col-auto mb-2">
        <div class="row">
            <div class="col-auto btn tag-gray">Права роли</div>
            @if($rights && $item->code != $item::ADMIN)
                <div class="col-auto">
                    {!! Form::submit('Сохранить', ['class' => 'btn tag-green-clickable', 'style' => 'font-size: 16px;']) !!}
                </div>
            @endif
        </div>
    </div>

    <div class="row card-main pb-4">
        @if($rights)
            @foreach($rights as $right)
                <div class="form-check form-switch mt-3">
                        {!! Form::checkbox($right->id, 1, 0, ['class' => 'form-check-input', 'checked' => $item->can($right->code), 'disabled' => $item->code == $item::ADMIN || Auth::user()->cannot('right.moderate')]); !!}
                        {!! Form::label($right->id, $right->description, ['class' => 'form-check-label']); !!}
{{--                    <input class="form-check-input" type="checkbox" name="right" {{ $item->can($right->code) ? 'checked' : '' }} {{ $item->code == $item::ADMIN ? 'disabled' : '' }}>--}}
{{--                    <label class="form-check-label" for="right">{{ $right->description }}</label>--}}
                </div>
            @endforeach
        @else
            <span class="mt-3">У роли нет дополнительных прав</span>
        @endif
    </div>
    {!! Form::close() !!}
@stop

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
