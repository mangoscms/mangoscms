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
                        <b>My Characters</b>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Race</th>
                                <th>Class</th>
                                <th>Gender</th>
                                <th>Level</th>
                                <th>XP</th>
                                <th>Money</th>
                                <th>Playtime (hours)</th>
                            </tr>
                        @foreach ($characters as $character)
                            <tr>
                                <td>{{ $character->name }}</td>
                                <td>
                                    @if ($character->race === 1)
                                        Human
                                    @elseif ($character->race === 2)
                                        Orc
                                    @elseif ($character->race === 3)
                                        Dwarf
                                    @elseif ($character->race === 4)
                                        Night Elf
                                    @elseif ($character->race === 5)
                                        Undead
                                    @elseif ($character->race === 6)
                                        Tauren
                                    @elseif ($character->race === 7)
                                        Gnome
                                    @elseif ($character->race === 8)
                                        Troll
                                    @elseif ($character->race === 10)
                                        Bloodelf
                                    @elseif ($character->race === 11)
                                        Draenei
                                    @endif
                                </td>
                                <td>
                                    @if ($character->class === 1)
                                        Warrior
                                    @elseif ($character->class === 2)
                                        Paladin
                                    @elseif ($character->class === 3)
                                        Hunter
                                    @elseif ($character->class === 4)
                                        Rogue
                                    @elseif ($character->class === 5)
                                        Priest
                                    @elseif ($character->class === 6)
                                        Death Knight
                                    @elseif ($character->class === 7)
                                        Shaman
                                    @elseif ($character->class === 8)
                                        Mage
                                    @elseif ($character->class === 9)
                                        Warlock
                                    @elseif ($character->class === 11)
                                        Druid
                                    @endif
                                </td>
                                <td>
                                    @if ($character->gender === 0)
                                        Male
                                    @elseif ($character->gender === 1)
                                        Female
                                    @endif
                                </td>
                                <td>{{ $character->level }}</td>
                                <td>{{ $character->xp }}</td>
                                <td>{{ $character->money }}</td>
                                <td>{{ number_format($character->totaltime/60/60, 3) }}</td>
                            </tr>
                        @endforeach
                        </table>
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