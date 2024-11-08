<?php

namespace Database\Factories\Various;

use App\Models\various\IdentityDocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\various\IdentityDocumentType>
 */
class IdentityDocumentTypeFactory extends Factory
{
    protected $model = IdentityDocumentType::class;

    public function definition(): array
    {
        static $index = 0;

        // Valores por defecto en la base de datos
        $documentTypes = [
            ['name' => 'documento nacional de identidad', 'abbreviation' => 'dni', 'digit_length' => 8],
            ['name' => 'registro unico de contribuyente', 'abbreviation' => 'ruc', 'digit_length' => 11],
            // ['name' => 'carnet de extranjeria', 'abbreviation' => 'carnet ext.', 'digit_length' => 12],
            // ['name' => 'pasaporte', 'abbreviation' => 'pasaporte', 'digit_length' => 12],
        ];

        $dt = $documentTypes[$index];
        $index++;

        return [
            'name' => $dt['name'],
            'abbreviation' => $dt['abbreviation'],
            'digit_length' => $dt['digit_length'],
        ];
    }
}
