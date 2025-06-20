<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            DirectionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            IndexSeeder::class,
            CatalogSeeder::class,
            CargoSearchSeeder::class,
            TransportSearchSeeder::class,
            ContactSeeder::class,

            ReviewSeeder::class,
            ProfileSeeder::class,
            SettingSeeder::class,

            CargoTypeSeeder::class,
            PackageSeeder::class,
            CountrySeeder::class,
            PartnersSeeder::class,
            LangSeeder::class,
            BannerSeeder::class,
        ]);
    }
}
