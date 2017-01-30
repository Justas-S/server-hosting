<form method="POST" action="{{ route('order.store') }}">
    @include('includes.csrf')
    <div class="form-group row">
        <label for="ip" class="col-form-label col-md-4">IP</label>
        <div class="col-md-6">
            <select name="ip" id="ip" class="form-control">
                @foreach($gameservers as $gameserver)
                    <option value="{{ $gameserver->ip }}" @if($gameserver->ip == $ip) selected="1" @endif>{{ $gameserver->ip }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="duration" class="col-md-4 col-form-label">Periodas</label>
        <div class="col-md-6">
            <select name="duration" id="duration" class="form-control">
                <option value="7">1 savaitė</option>
                <option value="14">2 savaitės</option>
                <option value="30">1 mėnesis</option>
                <option value="60">2 mėnesiai</option>
                <option value="90">3 mėnesiai</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn">Užsakyti</button>
</form>