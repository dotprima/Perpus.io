<?php 

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $faker = \Faker\Factory::create('id_ID');
                for($i=0;$i<100;$i++)
                {
                    $text = '123123123';
                        $data = [
                                'name' => $faker->name,
                                'email' => $faker->email,
                                'address' => $faker->address,
                                'phone' => $faker->phoneNumber,
                                'nik' => $faker->nik,
                                'password' => password_hash($text, PASSWORD_BCRYPT),
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s"),
                        ];     
                        $this->db->table('users')->insert($data);
                }
                
        }
}