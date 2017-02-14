<ul class="nav nav-pills nav-stacked nav-default">
    <li role="presentation" class="@if(Request::url() == route('user.index')) active @endif"><a href="{{ route('user.index') }}">Užsakymai</a></li>
    <li role="presentation"><a href="#">Nustatymai</a></li>
    <li role="presentation"><a href="#">Užsakymų istorija</a></li>
</ul>