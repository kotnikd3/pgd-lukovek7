<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use App\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use TypeOfNews;

class News extends Model
{
    /**
     * Type of the News.
     * V primeru posodobitve je potrebno spremeniti se v datotekah:
     * - edit.blade.php
     * - create.blade.php
     * - Tag.vue
     */
    public const TYPE = [
        'obvestilo' => 'Obvestilo',
        'intervencija' => 'Intervencija',
        'tekmovanje' => 'Tekmovanje',
        'vaja' => 'Vaja',
        'dogodek' => 'Dogodek',
        'ostalo' => 'Ostalo'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'user_id'
    ];

    private $slo_months = [
        1 => 'januar',
        2 => 'februat',
        3 => 'marec',
        4 => 'april',
        5 => 'maj',
        6 => 'junij',
        7 => 'julij',
        8 => 'avgust',
        9 => 'september',
        10 => 'oktober',
        11 => 'november',
        12 => 'december'
    ];

    /** 
     * Atributi bodo dodani v JSON in v Array.
    */
    protected $appends = ['can_update', 'can_delete', 'cover_image'];

    public function getCanUpdateAttribute()
    {
        return Gate::allows('update', $this);
    }

    public function getCanDeleteAttribute()
    {
        return Gate::allows('delete', $this);
    }

    /**
     * Ce obstaja slika novice, vrni pot do prve slike, sicer prazen niz. 
     */
    public function getCoverImageAttribute()
    {
        // Ce je kaksna slika.
        if (count(Storage::disk('public')->files('news/' . $this->id)) > 0) {
            // Vrni prvo sliko. Ideja: vrni nakljucno sliko.
            return '/storage/' . Storage::disk('public')->files('news/' . $this->id)[0];
        }
        return '';
    }

    /**
     * Datum v slovenskem formatu: 28. april 2019
    */
    public function getCreatedAtSloAttribute()
    {
        // array_get($array, $key, $default_value)

        $mesec = Arr::get($this->slo_months, $this->created_at->format('n'), 'NAPAKA');
        return sprintf("%s. %s %s", $this->created_at->format('j'), $mesec, $this->created_at->format('Y H:i'));
    }

    public function owner()
    {
        // Pridobi lastnika, tudi ce je ta izbrisan, vendar samo dolocena polja.
        return $this->belongsTo(User::class, 'user_id')->withTrashed()->select(['id', 'name', 'surname','email']);
    }
}
