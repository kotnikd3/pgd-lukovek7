@extends('layouts.app')

@section('body')
    <div class="columns is-centered">
        <div class="column is-half-tablet is-3-desktop">
            <form method="POST" action="{{ route('register') }}" class="box">
                @csrf

                <!-- Ime -->
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" placeholder="Ime" name="name" value="{{ old('name') }}" required>
                    </p>
                    @if ($errors->any('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Priimek -->
                <div class="field">
                    <p class="control">
                        <input class="input" type="text" placeholder="Priimek" name="surname" required>
                    </p>
                    @if ($errors->any('surname'))
                        <p class="help is-danger">{{ $errors->first('surname') }}</p>
                    @endif
                </div>

                <!-- E-posta -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="email" placeholder="E-pošta" name="email" required>
                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                    </p>
                    @if ($errors->any('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Geslo -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Geslo" name="password" required>
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                    </p>
                    @if ($errors->any('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Ponovi geslo -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Ponovi geslo" name="password_confirmation" required>
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                    </p>
                </div>

                <button type="submit" class="button is-success is-fullwidth">Registracija uporabnika</button>
            </form>
        </div>
    </div>
@endsection
