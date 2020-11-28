<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- SEO: Denis Kotnik https://www.kotnik.si Denis Kotnik https://www.kotnik.si Denis Kotnik -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Naslov in ikona v oknu brskalnika -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- Landig page z menijem. -->
        <section class="hero is-danger is-medium">            
            <!-- Hero content: will be in the middle -->
            <div class="hero-body">
                <div class="container has-text-centered">
                    <h1 class="title">
                        PGD Lukovek
                    </h1>
                    <h2 class="subtitle">
                        Prostovoljno gasilsko društvo Lukovek
                    </h2>
                </div>
            </div>
        </section>
        <!-- Navbar  -->
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-menu">
                    <div class="navbar-end">
                        <router-link to="/" tag="a" class="navbar-item" exact>
                            <span>
                                <span class="icon"><i class="fas fa-home"></i></span>
                                Domov
                            </span>
                        </router-link>
                        <router-link to="/about" exact tag="a" class="navbar-item">
                            O društvu
                        </router-link>
                        <router-link to="/files" exact tag="a" class="navbar-item">
                            Datoteke
                        </router-link>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <router-link to="/dwad" tag="a" class="navbar-item navbar-link">
                                Novice
                            </router-link>
                        
                            <div class="navbar-dropdown">
                                <router-link to="/jjk" tag="a" class="navbar-item">
                                    <span>
                                        <span class="icon"><i class="fas fa-home"></i></span>
                                        Tekmovanja
                                    </span>
                                </router-link>
                                <a class="navbar-item">
                                    Elements
                                </a>
                            </div>
                        </div>
                        @auth
                            <router-link to="/users" exact tag="a" class="navbar-item">
                                <span>
                                    <span class="icon"><i class="fas fa-users"></i></span>
                                    Uporabniki
                                </span>
                            </router-link>
                        @endauth
                    </div>
                    <div class="navbar-end">
                        @auth
                            <a class="navbar-item" title="Odjava ({!! auth()->user()->email !!})" @click="logout">
                                <span>
                                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                                    Odjava
                                </span>
                            </a>
                        @else
                            <router-link to="/login" title="Prijava" tag="a" class="navbar-item">
                                <span class="icon">
                                    <i class="fas fa-sign-in-alt"></i>
                                </span>
                            </router-link>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <section class="section">
            @yield('body')
        </section>

        <!-- Noga -->
        <footer class="footer">
            <div class="container">
                <!-- Prva vrsta -->
                <div class="columns is-centered has-text-centered">
                    <!-- Prvi stolpec -->
                    <div class="column is-3-desktop">
                            <h1 class="title is-4">
                                <span>
                                    <span class="icon"><i class="fas fa-map-marked-alt"></i></span>
                                    Naslov
                                </span>
                            </h1>
                            <h2 class="subtitle is-6">
                                <span>PGD Lukovek<br>Lukovek 52<br>8210 Trebnje</span>
                            </h2>
                            <a class="button is-small is-outlined is-info" href="https://www.google.com/maps/place/Lukovek+52,+8210+Trebnje/@45.9030474,15.0673528,17z/data=!3m1!4b1!4m5!3m4!1s0x476504823be32011:0x470552ffcf6d9146!8m2!3d45.9030437!4d15.0695415">Zemljevidi Google</a>
                    </div>
                    <!-- Drugi stolpec -->
                    <div class="column is-3-desktop">
                        <h1 class="title is-4">Kontakt</h1>
                        <h2 class="subtitle is-6">
                            <span>
                                <span class="icon"><i class="fas fa-phone-volume"></i></span>
                                041-888-888<br>
                            </span>
                                <span class="icon"><i class="fas fa-at"></i></span>
                                pgdlukovek@gz.si
                            </span>
                        </h2>
                    </div>
                    <!-- Tretji stolpec -->
                    <div class="column is-3-desktop">
                        <h1 class="title is-4">Splošno</h1>
                        <h2 class="subtitle is-6">
                            <h2 class="subtitle is-6">
                                <span>TRR: SI56 8888 8888 8888<br>Davčna št.: 888888</span>
                            </h2>
                        </h2>
                    </div>
                </div>
                <!-- Druga vrsta -->
                <div class="columns is-centered has-text-centered">
                    <div class="column">
                        <span class="has-text-grey-light">
                            <span class="icon"><i class="far fa-copyright"></i></span>{{ now()->year }} PGD Lukovek.
                            Vse pravice pridržane. Izdelava <a class="has-text-grey-light" href="https://www.kotnik.si"><i>www.kotnik.si</i></a>
                        </span>
                    </div>
                </div>
            </div>    
        </footer>
    </div>
    {{-- <!-- Scripts --> --}}
    @auth
        <script>
            window.User = {
                'id' : {{ auth()->user()->id }},
                'email' : '{{ auth()->user()->email }}',
                'name' : '{{ auth()->user()->name }}',
                'surname' : '{{ auth()->user()->surname }}'
            }
        </script>
    @endauth
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
