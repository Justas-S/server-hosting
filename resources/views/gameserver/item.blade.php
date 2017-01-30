<div class="row game-server">
    <div class="col-md-1">
        @if($gameserver->user) Užimtas
        @else Laisvas
        @endif
    </div>
    <div class="col-md-2">
        {{ $gameserver->ip }}
    </div>
    <div class="col-md-3">
        {{ $gameserver->game->name }}
    </div>
    @if(!$gameserver->user)
    <div class="col-md-1">
        <a href="{{ route('order.create', ['ip' => $gameserver->ip, 'game' => $gameserver->game->identifier]) }}">Užsakyti</a>
    </div>
    @endif
</div>