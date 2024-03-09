<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $pinCode = rand(3, 100);
        for($i=1; $i < 10; $i++) {
            $data = [
                "first_name" => $faker->name,
                "last_name" => $faker->name,
                "email" => $faker->email,
                "address" => $faker->address,
                "city" => $faker->name,
                "state" => $faker->name,
                "country" => $faker->name,
                "hobbies" => $faker->name,
                "courses" => $faker->name,
                "pin_code" => $pinCode,
                "gender" => "m",
                "mobile_number" => $faker->numberBetween(111111111, 9999999999),
                "dob" => $faker->dateTime()
            ];
            Student::create($data);
            
        }

        // $data = [
        //     "name" => "Rohit",
        //     "email" => "rohit@gmail.com",
        //     "age" => 20,
        //     "gender" => "m",
        //     "class" => 10,
        //     "phone" => "987654321",
        //     "dob" => "2023-12-21 06:14:56"
        // ];
    }
}
