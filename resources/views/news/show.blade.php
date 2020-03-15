@extends('layouts.sidebars')

@section('content')
    <!-- Vrstica -->
    <div class="columns is-mobile is-centered">
        <div class="column is-narrow">
            <h1 class="title is-2 has-text-grey">{{ $news->title }}</h1>
            <h2 class="subtitle has-text-grey">
                <nav class="level">
                    <div class="level-item">
                        {{ $news->created_at_slo }}
                        <!-- 18. april 2019 -->
                    </div>
                    <div class="level-item">
                        <tag margin initialsize="is-normal" initialnewstype="{{ $news->type }}"></tag>
                    </div>
                </nav>
            </h2>
        </div>
    </div>
     <!-- Vrstica -->
    <div class="columns is-centered margin-top-50">
        <div class="column is-four-fifths">
            <!-- Vsebina -->
            <div class="content is-large">
                {{ $news->body }}
            </div>
        </div>
    </div>
    <!-- Ce ima novica ustvarjeno mapo s slikami. -->
    @if(Storage::disk('public')->exists('news/' . $news->id))
        <!-- Ustvarimo seznam vseh slik in ga podamo kot 'prop' v komponento Vue. -->
        <lightbox :imgs="{{ collect(Storage::disk('public')->files('news/' . $news->id))->map(function($file) { return '/storage/' . $file; }) }}"></lightbox>

        <!-- Vrstica -->
        <div class="columns is-multiline is-centered margin-top-50">
            <!-- Skozi vse slike v ustreznem direktoriju.. -->
            @foreach(Storage::disk('public')->files('news/' . $news->id) as $index=>$filepath)
                <div class="column image is-full-tablet is-5-desktop">
                    <figure>
                        <a @click="showLightbox({{ $index }})">
                            <img src="{{ asset('/storage/' . $filepath) }}" alt="alt text">
                        </a>
                    </figure>      
                </div>
            @endforeach
        </div>
    @endif
@endsection