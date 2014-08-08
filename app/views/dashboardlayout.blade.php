@extends('dashboard')

@section('head')
    @include('head')
@stop

@section('navigation')
    @include('navigation')
@stop

@section('news_form')
    {{ Form::open(array('url' => '/dashboard/news', 'role' => 'form')); }}
    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
            {{ Form::label('news_title', 'Title: '); }}
            <br>
            {{ Form::text('news_title'); }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                {{ Form::label('news_text', 'Text: '); }}
                <br>
                {{ Form::textarea('news_text'); }}
            </div>
        </div>
    </div>
    {{ Form::submit('Submit', array('class' => 'btn btn-default')); }}
    {{ Form::close(); }}
    @if($errors->has())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
@stop