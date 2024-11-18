<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Vendor::Create([
            'name' => 'Vendor',
            'email' => 'Vendor@demo.com',
            'phone' => '+0543037411',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);


        $vendor = Vendor::firstOrCreate([
            'name' => 'Vendor1',
            'email' => 'Vendor1@demo.com',
            'phone' => '+0543037412',
            'password' => 'Aa@12345',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        $vendors = [$root, $vendor];
        $bar = $this->command->getOutput()->createProgressBar(count($vendors));

        $bar->start();

        foreach ($vendors as $vendor) {
            $vendor->addRole('vendor');
            $bar->advance();
        }

        $bar->finish();
        $this->command->info("admins roles attached successfully");

    }
}
