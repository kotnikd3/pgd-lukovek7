@extends('layouts.app')

@section('body')
    <div class="columns is-mobile is-centered">
        <div class="column is-narrow">
            <h1 class="title is-2 has-text-grey">Uredi novico</h1>
        </div>
    </div>
    <div class="columns is-centered">
        <div class="column is-half-tablet">
            <form method="POST" enctype="multipart/form-data" action="/news/{{ $news->id }}" class="box">
                @method('PATCH')
                @csrf

                <!-- Naslov -->
                <div class="field">
                    <label class="label">Naslov</label>
                    <p class="control">
                        <input class="input" type="text" placeholder="Naslov" name="title" value="{{ $news->title }}" required>
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
                                    <label class="radio"><input type="radio" name="type" value="{{ $news::TYPE['obvestilo'] }}" @click="changeTagColor('{{ $news::TYPE['obvestilo'] }}')" {{ $news->type == 'Obvestilo' ? 'checked' : ''}}>Obvestilo</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $news::TYPE['intervencija'] }}" @click="changeTagColor('{{ $news::TYPE['intervencija'] }}')" {{ $news->type == 'Intervencija' ? 'checked' : ''}}>Intervencija</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $news::TYPE['tekmovanje'] }}" @click="changeTagColor('{{ $news::TYPE['tekmovanje'] }}')" {{ $news->type == 'Tekmovanje' ? 'checked' : ''}}>Tekmovanje</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $news::TYPE['vaja'] }}" @click="changeTagColor('{{ $news::TYPE['vaja'] }}')" {{ $news->type == 'Vaja' ? 'checked' : ''}}>Vaja</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $news::TYPE['dogodek'] }}" @click="changeTagColor('{{ $news::TYPE['dogodek'] }}')" {{ $news->type == 'Dogodek' ? 'checked' : ''}}>Dogodek</label>
                                    <label class="radio"><input type="radio" name="type" value="{{ $news::TYPE['ostalo'] }}" @click="changeTagColor('{{ $news::TYPE['ostalo'] }}')" {{ $news->type == 'Ostalo' ? 'checked' : ''}}>Ostalo</label>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <tag initialsize="is-medium" initialnewstype="{{ $news->type }}"></tag>
                            </div>
                        </div>
                    </nav>
                    
                </div>

                <!-- Vsebina -->
                <div class="field">
                    <label class="label">Vsebina</label>
                    <textarea class="textarea" placeholder="Vsebina novice" name="body" required>{{ $news->body }}</textarea>
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

                <!-- Prikaz slik in moznost izbrisa. -->
                @if(Storage::disk('public')->exists('news/' . $news->id))
                    <div class="field">
                        <!-- Vrstica -->
                        <div class="margin-top-50">
                            <!-- Skozi vse slike v ustreznem direktoriju.. -->
                            @foreach(Storage::disk('public')->files('news/' . $news->id) as $filepath)
                                <div class="columns is-mobile">
                                    <div class="column is-four-fifths image">
                                        <figure>
                                            <img src="{{ asset('/storage/' . $filepath) }}" alt="alt text">
                                        </figure>
                                    </div>
                                    <div class="column">
                                        <label class="is-size-5 has-text-danger checkbox"><input name="delete[]" type="checkbox" value="{{ $filepath }}">Izbriši</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <button type="submit" class="margin-top-50 button is-info is-fullwidth">Posodobi</button>
            </form>
        </div>
    </div>
@endsection
