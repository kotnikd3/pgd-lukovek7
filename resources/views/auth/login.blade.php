@extends('layouts.app')

@section('body')
    <div class="columns is-centered">
        <div class="column is-half-tablet is-3-desktop">
            <form method="POST" action="{{ route('login') }}" class="box">
                @csrf
                <!-- E-posta -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="email" placeholder="E-pošta" name="email" required autofocus>
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
                <div class="field">
                    <a href="/password/reset">Pozabljeno geslo</a>
                </div>
                <button type="submit" class="button is-info is-fullwidth">Prijava</button>
            </form>
        </div>
    </div>
@endsection
