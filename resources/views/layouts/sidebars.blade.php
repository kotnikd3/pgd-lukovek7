@extends('layouts.app')

@section('body')
    <div class="columns">
        <!-- Prvi stolpec -->
        <div class="column is-3-tablet is-2-desktop">
            <!-- Panel ob 112 sporocite  -->
            <nav class="panel">
                <p class="panel-heading">Ob klicu v sili na <span class="title is-3 has-text-danger">112</span> sporočite</p>
                <div class="panel-block">
                    <p><span class="has-text-danger has-text-weight-bold">KAJ</span> se je zgodilo?</p>
                </div>
                <div class="panel-block">
                    <p><span class="has-text-danger has-text-weight-bold">KJE</span> se je zgodilo?</p>
                </div>
                <div class="panel-block">
                    <p><span class="has-text-danger has-text-weight-bold">KDO</span> kliče?</p>
                </div>
                <div class="panel-block">
                    <p><span class="has-text-danger has-text-weight-bold">KDAJ</span> se je zgodilo?</p>
                </div>
                <div class="panel-block">
                    <p><span class="has-text-danger has-text-weight-bold">KOLIKO</span> je ponesrečencev?</p>
                </div>
                <div class="panel-block">
                    <p>Kakšne so <span class="has-text-danger has-text-weight-bold">POŠKODBE</span>?</p>
                </div>
                <div class="panel-block">
                    <p>Kakšne so <span class="has-text-danger has-text-weight-bold">OKOLIŠČINE</span>?</p>
                </div>
                <div class="panel-block">
                    <p>Kakšno <span class="has-text-danger has-text-weight-bold">POMOČ</span> potrebujete?</p>
                </div>
            </nav>
            <!-- Panel intervencije SPIN -->
            <nav class="panel">
                <p class="panel-heading">Pregled intervencij SPIN</p>
                <div class="panel-block">
                    <a href="https://spin3.sos112.si/javno/zemljevid">
                        <img src="{{ asset('/images/spin_logo.png') }}" alt="alt text">
                    </a>               
                </div>
            </nav>
        </div>
        <!-- Drugi stolpec -->
        <div class="column is-5-tablet is-7-desktop">
            <!-- Obvestilo o izbrisu uporabnika. -->
            @if (session('delete'))
                <div class="columns is-centered">
                    <div class="column is-half-desktop has-text-centered">
                        <div class="notification is-warning">
                            {{ session('delete') }} 
                        </div>
                    </div>
                </div> 
            @endif

            <!-- Obvestilo o dodajanju novice. -->
            @if (session('created'))
                <div class="columns is-centered">
                    <div class="column is-half-desktop has-text-centered">
                        <div class="notification is-success">
                            {{ session('created') }} 
                        </div>
                    </div>
                </div> 
            @endif

            <!-- Obvestilo o posodobitvi novice. -->
            @if (session('update'))
                <div class="columns is-centered">
                    <div class="column is-half-desktop has-text-centered">
                        <div class="notification is-info">
                            {{ session('update') }} 
                        </div>
                    </div>
                </div> 
            @endif

            @yield('content')
        </div>
        <!-- Tretji stolpec -->
        <div class="column is-4-tablet is-3-desktop">
            <!-- Panel pozarna ogrozenost ARSO -->
            <nav class="panel">
                <p class="panel-heading">Požarna ogroženost</p>
                <div class="panel-block">
                    <figure>
                        <a href="http://meteo.arso.gov.si/met/sl/warning/fire/">
                            <img src="{{ asset('/storage/arso/pozar.png') }}" class="css-class" alt="alt text">
                        </a>                
                        <figcaption>Vir: ARSO</figcaption>
                    </figure>                              
                </div>
            </nav>
            <!-- Panel vremenska napoved ARSO -->
            <nav class="panel">
                <p class="panel-heading">Vremenska napoved</p>
                <p class="panel-tabs">
                    <a :class="{ 'is-active' : tabWeather == 'danes' }" @click="tabWeather = 'danes'">Danes</a>
                    <a :class="{ 'is-active' : tabWeather == 'jutri_dop' }" @click="tabWeather = 'jutri_dop'">Jutri zjutraj</a>
                    <a :class="{ 'is-active' : tabWeather == 'jutri_pop' }" @click="tabWeather = 'jutri_pop'">Jutri popoldan</a>
                </p>
                <!-- Tab danes -->
                <div class="panel-block" v-show="tabWeather == 'danes'">
                    <figure>
                        <a href="http://meteo.arso.gov.si/met/sl/weather/fproduct/graphic/general/">
                            <img src="{{ asset('/storage/arso/danes.png') }}" class="css-class" alt="alt text" title="Slikovne napovedi dežurnega prognostika ARSO">
                        </a>                
                        <figcaption>Vir: ARSO</figcaption>
                    </figure>                              
                </div>
                <!-- Tab jutri dopoldan -->
                <div class="panel-block" v-show="tabWeather == 'jutri_dop'">
                    <figure>
                        <a href="http://meteo.arso.gov.si/met/sl/weather/fproduct/graphic/general/">
                            <img src="{{ asset('/storage/arso/jutri_dop.png') }}" class="css-class" alt="alt text">
                        </a>                
                        <figcaption>Vir: ARSO</figcaption>
                    </figure>                              
                </div>
                <!-- Tab jutri popoldan -->
                <div class="panel-block" v-show="tabWeather == 'jutri_pop'">
                    <figure>
                        <a href="http://meteo.arso.gov.si/met/sl/weather/fproduct/graphic/general/">
                            <img src="{{ asset('/storage/arso/jutri_pop.png') }}" class="css-class" alt="alt text">
                        </a>                
                        <figcaption>Vir: ARSO</figcaption>
                    </figure>                              
                </div>
            </nav>
            <!-- Panel vremenska opozorila ARSO in Meteoalarm -->
            <nav class="panel">
                <p class="panel-heading">Vremenska opozorila ARSO in Meteoalarm</p>
                <div class="panel-block">
                    <div class="tile is-ancestor">
                        <div class="tile is-4 is-parent">
                            <div class="tile is-child">
                                <a href="http://meteo.arso.gov.si/met/sl/warning/">
                                    <img src="{{ asset('/images/logo-arso.png') }}" class="css-class" alt="alt text">
                                </a>
                            </div>
                        </div>
                        <div class="tile is-8 is-parent">
                            <div class="tile is-child">
                                <a href="http://meteoalarm.eu/sl_SI/1/0/SI-Slovenija.html">
                                    <img src="{{ asset('/images/meteoalarm.jpg') }}" class="css-class" alt="alt text">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
@endsection