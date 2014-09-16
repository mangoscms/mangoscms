@if (Auth::guest())
    {{ Form::open(array('url' => 'login', 'role' => 'form')); }}
    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
                {{ Form::label('login_form_username', 'Username:'); }}
                {{ Form::text('login_form_username'); }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
                {{ Form::label('login_form_password', 'Password:'); }}
                {{ Form::password('login_form_password'); }}
            </div>
        </div>
    </div>
    <div class="btn-group">
    {{ Form::submit('Log in', array('id' => 'login_form_submit', 'class' => 'btn btn-default')); }}
    <a href="{{ URL::to('register') }}">{{ Form::button('Register', array('class' => 'btn btn-default')) }}</a>
    </div>
    {{ Form::close(); }}
<script>
    $( "#login_form_username" ).mouseleave(function() {
    var UsernameField = document.getElementById("login_form_username");
    var SubmitButton = document.getElementById("login_form_submit");
        if ($( "#login_form_username" ).val().length < 3 || $("#login_form_username").val().length > 16) {
            UsernameField.style.backgroundColor = "#FF0000";
            SubmitButton.disabled = true;
        }
        else {
            UsernameField.style.backgroundColor = "#00FF00";
            SubmitButton.disabled = false;
        }
    });

    $( "#login_form_password" ).mouseleave(function() {
    var PasswordField = document.getElementById("login_form_password");
    var SubmitButton = document.getElementById("login_form_submit");
        if ($( "#login_form_password" ).val().length < 5) {
            PasswordField.style.backgroundColor = "#FF0000";
            SubmitButton.disabled = true;
        }
        else {
            PasswordField.style.backgroundColor = "#00FF00";
            SubmitButton.disabled = false;
        }
    });

    $( "#login_form_submit" ).click( function() {
    var UsernameField = document.getElementById("login_form_username");
    var PasswordField = document.getElementById("login_form_password");
    var SubmitButton = document.getElementById("login_form_submit");
    var errors = false;
        if ($( "#login_form_username" ).val().length < 3 || $("#login_form_username").val().length > 16) {
            UsernameField.style.backgroundColor = "#FF0000";
            SubmitButton.disabled = true;
            var errors = true;
        }

        if ($( "#login_form_password" ).val().length < 5) {
            PasswordField.style.backgroundColor = "#FF0000";
            SubmitButton.disabled = true;
            var errors = true;
        }

        if (errors)
        {
            return false;
        }
    });
</script>
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