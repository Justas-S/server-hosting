<form method="POST" action="{{ route('server.store') }}" class="row">
    @include('includes.csrf')
    <div class="form-group row">
        <label for="provider" class="col-md-3 col-form-label">Tiekėjas</label>
        <div class="col-md-8">
            <input type="text" id="provider" name="provider" value="{{ old('provider') }}" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="ip" class="col-md-3 col-form-label">IP adresas</label>
        <div class="col-md-8">
            <input type="text" name="ip" id="ip" value="{{ old('ip') }}" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-3 col-form-label"><em>root</em> vartotojo slaptažodis</label>
        <div class="col-md-8">
            <input type="password" name="password" id="password" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Pridėti</button>
</form>