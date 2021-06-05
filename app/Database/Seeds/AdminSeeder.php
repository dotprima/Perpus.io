<?php 

namespace App\Database\Seeds;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $faker = \Faker\Factory::create('id_ID');
                for($i=0;$i<5;$i++)
                {
                    $text = '123123123';
                        $data = [
                                'name' => $faker->name,
                                'email' => $faker->email,
                                'address' => $faker->address,
                                'phone' => $faker->address,
                                'nik' => $faker->nik,
                                'password' => password_hash($text, PASSWORD_BCRYPT),
                                'created_at' => date("Y-m-d H:i:s"),
                        ];     
                        $this->db->table('admin')->insert($data);
                }
                
        }
}