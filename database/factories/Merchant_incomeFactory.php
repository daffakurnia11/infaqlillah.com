<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Merchant_incomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $month = 0;
        $monthlist = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        if ($month == 12) {
            $month = 1;
        }

        return [
            'merchant_id'       => mt_rand(1, 50),
            'period'            => $monthlist[$month++],
            'nominal'           => $this->faker->numerify('#00000'),
        ];
    }
}
