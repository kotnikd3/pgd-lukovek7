@extends('layouts.app')

@section('body')
    <div class="columns is-mobile is-centered">
        <div class="column is-narrow">
            <h1 class="title is-2 has-text-grey">Ustvari novico</h1>
        </div>
    </div>
    <div class="columns is-centered">
        <div class="column is-half-tablet">
            <form id="myform" enctype="multipart/form-data" method="POST" action="/news" class="box">
                @csrf

                <!-- Naslov -->
                <div class="field">
                    <label class="label">Naslov</label>
                    <p class="control">
                        <input class="input" type="text" placeholder="Naslov" name="title" value="{{ old('title') }}" required>
                    </p>
                    @if ($errors->any('title'))
                        <p class="help is-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <!-- Tip novice/obvestila-->
                <div class="field">
                    <label class="label">Tip</label>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="control">
                                    <label class="radio"><input type="radio" name="type" value="{{ $type['obvestilo'] }}" @click="changeTagColor('{{ $type['obvestilo'] }}')" checked>Obvestilo</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $type['intervencija'] }}" @click="changeTagColor('{{ $type['intervencija'] }}')">Intervencija</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $type['tekmovanje'] }}" @click="changeTagColor('{{ $type['tekmovanje'] }}')">Tekmovanje</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $type['vaja'] }}" @click="changeTagColor('{{ $type['vaja'] }}')">Vaja</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $type['dogodek'] }}" @click="changeTagColor('{{ $type['dogodek'] }}')">Dogodek</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $type['ostalo'] }}" @click="changeTagColor('{{ $type['ostalo'] }}')">Ostalo</label>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <tag initialsize="is-medium"></tag>
                            </div>
                        </div>
                    </nav>
                </div>
                
                <!-- Vsebina -->
                <div class="field">
                    <label class="label">Vsebina</label>
                    <textarea class="textarea" placeholder="Vsebina novice" name="body" rows="10" value="{{ old('body') }}" required></textarea>
                        @if ($errors->any('body'))
                            <p class="help is-danger">{{ $errors->first('body') }}</p>
                        @endif
                        @if ($errors->any('pictures.*'))
                            <p class="help is-danger">{{ $errors->first('pictures.*') }}</p>
                        @endif
                </div>

                <div class="field">
                    <label class="label">Slike</label>
                    <addimages></addimages>
                </div>
                
                <button type="submit" class="button is-success is-fullwidth">Ustvari</button>
            </form>
        </div>
    </div>
@endsection