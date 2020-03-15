@extends('layouts.app')

@section('body')

    <!-- Obvestilo o posiljanju e-poste. -->
    @if (session('status') && session('color'))
    <div class="columns is-centered">
        <div class="column is-half-desktop has-text-centered">
            <div class="notification is-{{ session('color')}}">
                {{ session('status') }} 
            </div>
        </div>
    </div> 
    @endif
    
    <div class="columns is-centered">
        <div class="column is-half-tablet is-3-desktop">
            <form method="POST" action="{{ route('password.email') }}" class="box">
                @csrf

                <!-- E-posta -->
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" id="email" type="email" placeholder="E-pošta" name="email" value="{{ old('email') }}" required autofocus>
                        <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                    </p>
                    @if ($errors->any('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <button type="submit" class="button is-info is-fullwidth">Pošlji povezavo na e-pošto</button>
            </form>
        </div>
    </div>
@endsection
