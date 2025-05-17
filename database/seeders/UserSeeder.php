<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'login' => 'dkyshka',
            'name' => 'Andrew admin',
            'email' => 'dkyshka25@gmail.com',
            'role_id' => Role::ADMIN,
            'password' => 'agdepassword'
        ]);

        User::create([
            'login' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => Role::ADMIN,
            'password' => 'agdepassword'
        ]);

        $user = User::create([
            'login' => 'carrier',
            'name' => 'Carrier',
            'email' => 'carrier@gmail.com',
            'role_id' => Role::CARRIER,
            'password' => 'agdepassword',
            'phone' => '+998909037044',
            'avatar' => '/storage/avatars/2025-05-04/68172ae2f155b.jpg'
        ]);

//        $company = $user->company()->create([
//            'name' => 'OOO TransInvest',
//            'country' => 'Uzbekistan',
//            'city' => 'Tashkent',
//            'address' => 'Tashkent, Yashnobod tumani',
//            'website' => 'https://google.com',
//            'description' => 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum',
//            'work_start_date' => '2002-01-01',
//            'employees_count' => 10,
//            'avatar' => 'https://naumovn808.github.io/euca/images/catalog-logo.avif',
//            'status_id' => 2,
//        ]);
//
//        $company->directions()->sync([1, 2, 3]);

//        $company->certificates()->create([
//            'image_path' => '/assets/images/catalog-inner.avif',
//        ]);

//        $company->phones()->create([
//            'phone' => '+998909037044',
//        ]);
//
//        $company->phones()->create([
//            'phone' => '+998909037046',
//        ]);
//
//        $company->emails()->create([
//            'email' => 'info@gmail.com',
//        ]);

        $user = User::create([
            'login' => 'consignor',
            'name' => 'Consignor',
            'email' => 'consignor@gmail.com',
            'role_id' => Role::CONSIGNOR,
            'password' => 'agdepassword',
            'phone' => '+998909037046',
            'avatar' => '/assets/images/catalog-inner.avif'
        ]);

//        $company = $user->company()->create([
//            'name' => 'OOO AviaTrans',
//            'country' => 'Uzbekistan',
//            'city' => 'Nukus',
//            'address' => 'Nukus, Nukus tumani',
//            'website' => 'https://google.com',
//            'description' => 'lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum',
//            'work_start_date' => '2010-01-01',
//            'employees_count' => 20,
//            'avatar' => '/assets/images/catalog-inner.avif',
//            'status_id' => 2,
//        ]);
//
//        $company->directions()->sync([1, 2, 3, 4, 5]);
//
//        $company->certificates()->create([
//            'image_path' => '/assets/images/catalog-inner.avif',
//        ]);
//
//        $company->phones()->create([
//            'phone' => '+998907777777',
//        ]);
//
//        $company->emails()->create([
//            'email' => 'info@gmail.com',
//        ]);
//
//        $company->emails()->create([
//            'email' => 'info2@gmail.com',
//        ]);

        $user = User::create([
            'login' => 'carrier-2',
            'name' => 'Carrier-2',
            'email' => 'carrier2@gmail.com',
            'role_id' => Role::CARRIER,
            'password' => 'agdepassword',
            'phone' => '+998909037044',
        ]);
    }
}
