<?php

namespace Database\Factories\Menu;

use App\Models\menu\Lounge;
use App\Models\menu\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    protected $model = Table::class;
    
    public function definition()
    {
        return [
            'lounge_id' => Lounge::factory(), // Se crea un salón en la creación de la mesa
            'code' => null, // Esto se actualizará más tarde
        ];
    }

    public function newWithCode($loungeId, $tableCount)
    {
        return [
            'lounge_id' => $loungeId,
            'code' => str_pad($tableCount + 1, 4, '0', STR_PAD_LEFT), // Códigos correlativos
        ];
    }

}
