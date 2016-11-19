<form method="POST" action="{{ route('auth.postRegister') }}" class="row">
    @include('includes.csrf')
    <div class="form-group row">
        <label for="username" class="col-form-label">Vartotojo vardas</label>
        <input type='text' id="username" name="username" class="form-control" value="{{ old('username') }}">
    </div>
    <div class="form-group row">
        <label for="password" class="col-form-label">Slaptažodis</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-form-label">Slaptažodžio patvirtinimas</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>
    <div class="form-group row">
        <label for="email" class="col-form-label">El. paštas</label>
        <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
    </div>
    <button type="submit" class="btn btn-primary">Registruotis</button>
</form>