<!DOCTYPE html>
<html>
    @yield('head')
    <body class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ Config::get('mangoscms.server.name') }}</h2>
                <h3>{{ Config::get('mangoscms.server.description') }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @yield('navigation')
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Register a new account</b>
                    </div>
                    <div class="panel-body">
                        @yield('registration_form')
                        <script>
                        $( "#username" ).mouseleave(function() {
                        var UsernameField = document.getElementById("username");
                        var SubmitButton = document.getElementById("submit");
                            if ($( "#username" ).val().length < 3 || $("#username").val().length > 16) {
                                UsernameField.style.backgroundColor = "#FF0000";
                                SubmitButton.disabled = true;
                            }
                            else {
                                UsernameField.style.backgroundColor = "#00FF00";
                                SubmitButton.disabled = false;
                            }
                        });

                        $( "#password" ).mouseleave(function() {
                        var PasswordField = document.getElementById("password");
                        var SubmitButton = document.getElementById("submit");
                            if ($( "#password" ).val().length < 5) {
                                PasswordField.style.backgroundColor = "#FF0000";
                                SubmitButton.disabled = true;
                            }
                            else {
                                PasswordField.style.backgroundColor = "#00FF00";
                                SubmitButton.disabled = false;
                            }
                        });

                        $( "#email" ).mouseleave(function() {
                        var EmailField = document.getElementById("email");
                        var SubmitButton = document.getElementById("submit");
                            if ($( "#email" ).val().length < 3 || EmailField.value.indexOf('@') === -1) {
                                EmailField.style.backgroundColor = "#FF0000";
                                SubmitButton.disabled = true;
                            }
                            else {
                                EmailField.style.backgroundColor = "#00FF00";
                                SubmitButton.disabled = false;
                            }
                        });

                        $( "#submit" ).click( function() {
                        var UsernameField = document.getElementById("username");
                        var PasswordField = document.getElementById("password");
                        var EmailField = document.getElementById("email");
                        var SubmitButton = document.getElementById("submit");
                        var errors = false;
                            if ($( "#username" ).val().length < 3 || $("#username").val().length > 16) {
                                UsernameField.style.backgroundColor = "#FF0000";
                                SubmitButton.disabled = true;
                                var errors = true;
                            }

                            if ($( "#password" ).val().length < 5) {
                                PasswordField.style.backgroundColor = "#FF0000";
                                SubmitButton.disabled = true;
                                var errors = true;
                            }

                            if ($( "#email" ).val().length < 3 || EmailField.value.indexOf('@') === -1) {
                                EmailField.style.backgroundColor = "#FF0000";
                                SubmitButton.disabled = true;
                                var errors = true;
                            }
                            
                            if (errors)
                            {
                                return false;
                            }
                        });
                        </script>
                    </div>
                </div>
            </div>
             <div class="col-md-2">
                @yield('login_form')
                <hr>
                @foreach ($realms as $realm)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>{{{ $realm->id }}}.</b>
                            <b>{{{ $realm->name }}}</b>
                        </div>
                        <div class="panel-body">
                            @if ($realm->population <= 0.5)
                            <b>Population: <span style="color:green;">Low</span></b>
                            @elseif ($realm->population > 0.5 && $realm->population <=1.0)
                                <b>Population: <span style="color:yellow;">Medium</span></b>
                            @elseif ($realm->population > 1.0 && $realm->population <=2.0)
                                <b>Population: <span style="color:red;">High</span></b>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>