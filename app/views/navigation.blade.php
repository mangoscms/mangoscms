<nav class="navbar" role="navigation">
    <ul class="nav nav-tabs">
        <li><a href="{{ URL::to('/') }}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="{{ URL::to('/play') }}"><span class="glyphicon glyphicon-question-sign"></span> How to play</a></li>
        @if (!Auth::guest())
            <li><a href="{{ URL::to('/character') }}">My Characters</a></li>
            @if (Auth::user()->gmlevel >= Config::get('mangoscms.admin.gmlevel'))
                <li><a href="{{ URL::to('/dashboard') }}"><span class="glyphicon glyphicon-wrench"></span> Dashboard</a></li>
            @endif
            <li><a href="{{ URL::to('/logout') }}"><span class="glyphicon glyphicon-off"></span> Log out</a></li>
        @endif
    </ul>
</nav>