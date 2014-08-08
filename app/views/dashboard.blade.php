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
                <nav>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#news" data-toggle="tab"><span class="glyphicon glyphicon-pencil"></span> News</a></li>
                        <li><a href="#users" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Users</a></li>
                        <li><a href="#logs" data-toggle="tab"><span class="glyphicon glyphicon-info-sign"></span> Logs</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="news">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Add news article</b>
                                </div>
                                <div class="panel-body">
                                    @yield('news_form')
                                    <script>
                                        CKEDITOR.replace( 'news_text' );
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="users">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>UserID</th>
                                    <th>Username</th>
                                    <th>GMlevel</th>
                                    <th>Email</th>
                                    <th>Joindate</th>
                                    <th>Last IP</th>
                                    <th>Failed Logins</th>
                                    <th>Locked</th>
                                    <th>Last Login</th>
                                    <th>Expansion</th>
                                </tr>
                            @foreach ($users as $user)
                                <tr>
                                    @if ($user->id == Auth::user()->id)
                                        <td><span class="glyphicon glyphicon-remove"></span> {{ $user->id }}</td>
                                    @else
                                        <td><a href="{{ URL::action('HomeController@deleteUser', $user->id) }}"><span class="glyphicon glyphicon-remove"></span></a> {{ $user->id }}</td>
                                    @endif
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->gmlevel }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->joindate }}</td>
                                    <td>{{ $user->last_ip }}</td>
                                    <td>{{ $user->failed_logins }}</td>
                                    <td>{{ $user->locked }}</td>
                                    <td>{{ $user->last_login }}</td>
                                    <td>{{ $user->expansion }}</td>
                                </tr>
                            @endforeach
                            </table>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>GMlevel explanation</b>
                                </div>
                                <div class="panel-body">
                                    0 = Player <br>
                                    1 = Moderator <br>
                                    2 = Gamemaster <br>
                                    3 = Administrator
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="logs">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>LogID</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->logs_datetime }}</td>
                                    <td>
                                        @if ($log->logs_type === 1)
                                            User <b>{{ $log->logs_username }}</b> created the news article <b>{{{ $log->logs_relation }}}</b>.
                                        @elseif ($log->logs_type === 2)
                                            User <b>{{ $log->logs_username }}</b> deleted the news article <b>{{{ $log->logs_relation }}}</b>.
                                        @elseif ($log->logs_type === 3)
                                            User <b>{{ $log->logs_username }}</b> deleted the user <b>{{{ $log->logs_relation }}}</b>.
                                        @elseif ($log->logs_type === 4)
                                            User <b>{{ $log->logs_username }}</b> signed up with the IP <b>{{{ $log->logs_relation }}}</b>.
                                        @elseif ($log->logs_type === 5)
                                            User <b>{{ $log->logs_username }}</b> logged in with the IP <b>{{{ $log->logs_relation }}}</b>.
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                            {{ $logs->links(); }}
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </body>
</html>