@extends('app')

@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12">
        <img src="src/bg.png" class="img-welcome">
    </div>

    <div class="col-md-6 col-sm-12 ps-5" style="margin-top: 25%">
        <span style="font-size: 36px; color: #3D4150">Добро пожаловать</span><br>
        <span style="font-size: 36px; font-weight: 200; color: #7a7d82">Система управления персоналом <br></span>
    </div>
</div>
@stop

@section('style')
<style>
    .img-welcome {
        padding-top: 15%;
        width: 100%;
        height: 100%;
    }
</style>
@endsection
