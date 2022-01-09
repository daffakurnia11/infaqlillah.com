<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MerchantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $id = 1;
        $gender = ['Laki-laki', 'Perempuan'];
        $timestamp = '2021-' . $this->faker->month('+10 weeks') . '-' . $this->faker->dayOfMonth('+2 weeks') . ' ' . $this->faker->time();
        // $timestamp = $this->faker->dateTime();

        return [
            'number'        => $id++,
            'name'          => $this->faker->name(),
            'gender'        => $gender[mt_rand(0, 1)],
            'address'       => $this->faker->address(),
            'status'        => 'Aktif',
            'photo'         => 'default.jpg',
            'nominal'       => '500000',
            'received_at'   => $timestamp,
            'created_at'    => $timestamp
        ];
    }
}
