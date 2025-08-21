<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Captcha Configuration
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar las opciones del captcha matemático
    |
    */

    'enabled' => env('CAPTCHA_ENABLED', true),

    'operations' => [
        'add' => [
            'symbol' => '+',
            'min' => 1,
            'max' => 20,
        ],
        'subtract' => [
            'symbol' => '-',
            'min' => 10,
            'max' => 30,
        ],
        'multiply' => [
            'symbol' => '×',
            'min' => 2,
            'max' => 12,
        ],
    ],

    'session_key' => 'captcha_answer',

    'error_message' => 'La respuesta del captcha es incorrecta.',

    'refresh_button_text' => 'Refrescar',

    'placeholder' => 'Tu respuesta',

    'label' => 'Verificación de Seguridad',
];

