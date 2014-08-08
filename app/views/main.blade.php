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
                @foreach ($news as $newsitem)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @if (!Auth::guest())
                            <a href="{{ URL::action('HomeController@deleteNews', $newsitem->id) }}"><span class="glyphicon glyphicon-remove"></span></a>
                            @endif
                            <b>{{{ $newsitem->id }}}.</b>
                            <b>{{{ $newsitem->news_title }}}</b>
                            <div class="pull-right">
                                <b>{{{ $newsitem->news_date }}}</b> | <b>{{{ $newsitem->news_author }}}</b>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ $newsitem->news_text }}
                        </div>
                    </div>
                @endforeach
                {{ $news->links(); }}
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