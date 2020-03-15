@extends('layouts.app')

@section('body')
    <div class="columns is-centered">
        <div class="column is-half-tablet is-3-desktop">
            <form method="POST" action="{{ route('password.update') }}" class="box">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- E-posta -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" id="email" type="email" placeholder="E-pošta" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                    </p>
                    @if ($errors->any('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Geslo -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" id="password" type="password" placeholder="Geslo" name="password" required>
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                    </p>
                    @if ($errors->any('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Ponovi geslo -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" id="password-confirm" type="password" placeholder="Ponovi geslo" name="password_confirmation" required>
                        <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                    </p>
                </div>

                <button type="submit" class="button is-info is-fullwidth">Ponastavi geslo</button>
            </form>
        </div>
    </div>
@endsection
