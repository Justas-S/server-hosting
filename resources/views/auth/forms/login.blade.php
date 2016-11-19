<form action="{{ route('auth.postLogin') }}" method="POST" class="row">
    @include('includes.csrf')
    <div class="form-group row">
        <label for="username" class="col-form-label">Vartotojo vardas</label>
        <input type='text' id="username" name="username" class="form-control">
    </div>
    <div class="form-group row">
        <label for="password" class="col-form-label">Slaptažodis</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Prisijungti</button>
</form>