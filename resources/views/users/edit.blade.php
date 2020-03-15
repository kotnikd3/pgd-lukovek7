@extends('layouts.app')

@section('body')
<div class="columns is-centered">
    <div class="column is-half-tablet">
        <form method="POST" action="/users/{{ $user->id }}" class="box">
            @method('PATCH')
            @csrf

            <!-- Ime -->
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="text" placeholder="Ime" name="name" value="{{ $user->name }}" required>
                </p>
                @if ($errors->any('name'))
                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <!-- Priimek -->
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="text" placeholder="Priimek" name="surname" value="{{ $user->surname }}" required>
                </p>
                @if ($errors->any('surname'))
                    <p class="help is-danger">{{ $errors->first('surname') }}</p>
                @endif
            </div>

            <!-- E-posta -->
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="email" placeholder="E-pošta" name="email" value="{{ $user->email }}" required>
                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                </p>
                @if ($errors->any('email'))
                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <button type="submit" class="button is-info is-fullwidth">Posodobi</button>
        </form>
    </div>
</div>
@endsection
