<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class Users extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 100; $i++) {
			$jk = $faker->randomElement(['pria', 'wanita']);
			if ($jk == "pria") {
				$gender = "male";
			} else {
				$gender = "female";
			}
			$name = $faker->userName;
			$data = [
				'username' => $name,
				'name' => $faker->name($gender),
				'password' => password_hash($name, PASSWORD_BCRYPT),
				'tlp' => $faker->phoneNumber,
				'address' => $faker->address,
				'email' => $faker->email,
				'created_at' => Time::now(),
				'updated_at' => Time::now(),
			];
			$this->db->table('users')->insert($data);
		}
	}
}