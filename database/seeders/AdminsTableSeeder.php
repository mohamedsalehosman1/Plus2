<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Admin::Create([
            'name' => 'Root',
            'email' => 'root@demo.com',
            'phone' => '+0543037411',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);


        $admin = Admin::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'phone' => '+0543037412',
            'password' => 'Aa@12345',
            
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        $admins = [$root, $admin];
        $bar = $this->command->getOutput()->createProgressBar(count($admins));

        $bar->start();

        foreach ($admins as $admin) {
            $admin->addRole('super_admin');
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("admins roles attached successfully");

    }
}
