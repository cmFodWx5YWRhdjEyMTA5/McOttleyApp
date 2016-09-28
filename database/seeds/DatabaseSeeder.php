<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('accounts')->insert([ //,
                'account_number'=> $faker -> ean8,
                'account_type'=> 'Individual',
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'mobile_number' => $faker->phoneNumber,
                'postal_address'=> $faker->address,
                'residential_address'=> $faker->address,
                'date_of_birth'=> $faker->dateTime($max = 'now'),
                'field_of_activity'=> $faker->company,
                'account_manager'=> $faker->name,
                'sales_channel'=> 'Online sales through website',
                'status'=>'Active',
                'image'=>'avatar_default.jpg',
                'created_on'=>$faker->dateTime($max = 'now'),
                'created_by'=>$faker->name,
            ]);
        }
    }
}
