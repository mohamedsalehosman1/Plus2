<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    public function run()
    {
        $root = Vendor::Create([
            'name' => 'Vendor',
            'title' => 'Main Vendor',
            'email' => 'Vendor@demo.com',
            'phone' => '+0543037411',
            'password' => bcrypt('123456'),
            'service_id' => 1,
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        $vendor = Vendor::firstOrCreate([
            'name' => 'Vendor1',
            'title' => 'Secondary Vendor',
            'email' => 'Vendor1@demo.com',
            'phone' => '+0543037412',
            'password' => bcrypt('123456'),
            'service_id' => 1,
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
        $this->command->info("Vendor roles attached successfully");
    }
}
