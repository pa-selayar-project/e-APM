@extends('layouts.login')

@section('content')
<form method="POST" class="form-horizontal m-t-20" action="{{ route('login') }}">
    @csrf
    <div class="form-group ">
        <div class="col-xs-12">
            <input id="email" type="text" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('username') ?: old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 text-right">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>

    <div class="form-group ">
        <div class="col-xs-12">
            <div class="checkbox checkbox-primary">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="checkbox-signup">
                    Remember me
                </label>
            </div>
        </div>
    </div>
</form>
@endsection

@section('message')
    <p>Belum Punya Akun ? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Register</b></a> dulu!</p>

    <p>Kembali ke <a href="{{ url('/') }}" class="text-primary m-l-5"><b>Halaman Utama</b></a></p>
@endsection