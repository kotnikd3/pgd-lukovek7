@extends('layouts.app')

@section('body')

<!-- Ovestilo o posodabljanju uporabnika. -->
@if (session('update'))
    <div class="container">
        <div class="notification is-info has-text-centered">
            <h4 class="title is-4">
                {{ session('update') }}
            </h4>
        </div>
    </div>
@endif

<!-- Ovestilo o dodajanju uporabnika. -->
@if (session('register'))
    <div class="container">
        <div class="notification is-success has-text-centered">
            <h4 class="title is-4">
                {{ session('register') }}
            </h4>
        </div>
    </div>
@endif

<div class="container box"> 
    <table class="table is-striped is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th><abbr title="ID">ID</abbr></th>
                <th><abbr title="Ime">Ime</abbr></th>
                <th><abbr title="Priimek">Priimek</abbr></th>
                <th><abbr title="E-pošta">E-pošta</abbr></th>
                <th colspan="2">
                    @can('create', auth()->user())
                        <a href="/register" class="button is-success is-small">Dodaj uporabnika</a>
                    @endcan
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @can('update', $user)
                            <a href="/users/{{ $user->id }}/edit" class="button is-info is-small">Uredi</a>
                        @endcan
                    </td>
                    <td>
                        @can('delete', $user)
                            <form method="POST" action="/users/{{ $user->id }}">
                                @method('DELETE')
                                @csrf
                                <confirmbutton></confirmbutton>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
