<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'confirmed' => ':attribute se ne ujema.',
    'min' => [
        'string' => 'Polje :attribute mora vsebovati vsaj :min znakov.',
    ],
    'required' => 'Polje :attribute ne sme biti prazno.',
    'size' => [
        'numeric' => 'Polje :attribute mora biti velikosti :size.',
    ],
    'unique' => ':attribute s temi podatki že obstaja.',
    'image' => 'Vse izbrane datoteke morajo biti slike.',
    'mimes' => 'Izbrane slike morajo biti en izmed naslednijh tipov: :values.',
    'email' => 'Polje :attribute mora biti veljavno.',
    'max' => [
        'numeric' => 'Polje :attribute naj ne bo večje od :max.',
        'file' => 'Vsaka datoteka je lahko velika največ :max KB.',
        'string' => 'Niz :attribute naj ne bo daljši od :max znakov.',
        'array' => 'Polje :attribute naj ne vsebuje več kot :max elementov.',
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'e-pošta',
        'password' => 'geslo',
        'title' => 'naslov',
        'body' => 'vsebina',
        'pictures.*' => 'slika.*'
    ],

];