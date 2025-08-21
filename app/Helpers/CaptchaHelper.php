<?php

namespace App\Helpers;

class CaptchaHelper
{
    public static function generateCaptcha()
    {
        if (!config('captcha.enabled', true)) {
            return [
                'question' => 'Captcha deshabilitado',
                'answer' => 'disabled'
            ];
        }

        $operations = config('captcha.operations', []);
        $operation = array_rand($operations);
        $config = $operations[$operation];
        $operator = $config['symbol'];

        switch ($operation) {
            case 'add':
                $num1 = rand($config['min'], $config['max']);
                $num2 = rand($config['min'], $config['max']);
                $answer = $num1 + $num2;
                break;
            case 'subtract':
                $num1 = rand($config['min'], $config['max']);
                $num2 = rand($config['min'], $num1);
                $answer = $num1 - $num2;
                break;
            case 'multiply':
                $num1 = rand($config['min'], $config['max']);
                $num2 = rand($config['min'], $config['max']);
                $answer = $num1 * $num2;
                break;
            default:
                $num1 = rand(1, 10);
                $num2 = rand(1, 10);
                $answer = $num1 + $num2;
                $operator = '+';
        }

        return [
            'question' => "¿Cuánto es {$num1} {$operator} {$num2}?",
            'answer' => $answer
        ];
    }
}
