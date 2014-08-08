@if (Auth::guest())
    {{ Form::open(array('url' => '/', 'role' => 'form')); }}
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
    <div class="btn-group">
    {{ Form::submit('Log in', array('class' => 'btn btn-default')); }}
    <a href="{{ URL::to('/register') }}">{{ Form::button('Register', array('class' => 'btn btn-default')) }}</a>
    </div>
    {{ Form::close(); }}
    @if ($errors->login_form->has())
        <br>
        <div class="alert alert-danger">
        @foreach ($errors->login_form->all() as $error)
            {{ $error }}
        @endforeach
        </div>
    @endif
@else
    <div class="panel panel-default">
        <div class="panel-body">
            Username: <b>{{{ Auth::user()->username }}}</b>
            <br>
            UserID: <b>{{{ Auth::user()->id }}}</b>
            <br>
            GMlevel: <b>{{{ Auth::user()->gmlevel }}}</b>
        </div>
    </div>
@endif