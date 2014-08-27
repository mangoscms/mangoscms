@extends('register')

@section('head')
    @include('head')
@stop

@section('navigation')
    @include('navigation')
@stop

@section('login_form')
    @include('login_form')
@stop

@section('registration_form')
{{ Form::open(array('url' => '/register', 'role' => 'form')); }}
<div class="row">
    <div class="col-xs-2">
        <div class="form-group">
            {{ Form::label('username', 'Username:'); }}
            {{ Form::text('username'); }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-2">
        <div class="form-group">
            {{ Form::label('password', 'Password:'); }}
            {{ Form::password('password'); }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-2">
        <div class="form-group">
            {{ Form::label('email', 'Email:'); }}
            {{ Form::text('email'); }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-2">
        <div class="form-group">
            {{ Form::label('expansion', 'Expansion:'); }}
            <br>
            {{ Form::select('expansion', array('0' => 'Classic', '1' => 'TBC', '2' => 'WotLk', '3' => 'Cataclysm')); }}
        </div>
    </div>
</div>
{{ Form::submit('Register', array('id' => 'submit', 'class' => 'btn btn-default')); }}
{{ Form::close(); }}
@if($errors->register_form->has())
    <br>
    <div class="alert alert-danger">
    @foreach ($errors->register_form->all() as $error)
        {{ $error }}
    @endforeach
    </div>
@endif
@stop