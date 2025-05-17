<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kebzu
        $user = User::create([
            'full_name' => 'TLZ - KEBZU',
            'login' => 'kebzu',
            'name' => 'TLZ - KEBZU',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'xRNxPiy5xSQg',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/kebzU-qora.png'
        ]);

         $user->company()->create([
             'name' => 'TLZ - KEBZU',
             'country' => 'Узбекистан',
             'city' => '...',
             'address' => '...',
             'website' => null,
             'description' => '...',
             'work_start_date' => '2024-11-29',
             'employees_count' => 10,
             'avatar' => '/storage/avatars/2025-05-18/kebzU-qora.png',
             'status_id' => 2,
             'is_partner' => true,
        ]);

         // ETT Group
        $user = User::create([
            'full_name' => 'ETT Group',
            'login' => 'ettgroup',
            'name' => 'ETT Group',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'rKCS0hg8FIfq',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/ETT.png'
        ]);

        $user->company()->create([
            'name' => 'ETT Group',
            'country' => 'Казахстан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-2',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/ETT.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // Istiklol Nakiyot
        $user = User::create([
            'full_name' => 'Istiklol Nakiyot',
            'login' => 'istiklolnakiyot',
            'name' => 'Istiklol Nakiyot',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => '4myR1aLfdzgk',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Istiklol-Nakliyot-qora.png'
        ]);

        $user->company()->create([
            'name' => 'Istiklol Nakiyot',
            'country' => 'Таджикистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-3',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Istiklol-Nakliyot-qora.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // On Time Express
        $user = User::create([
            'full_name' => 'On Time Express',
            'login' => 'ontimeexpresscze',
            'name' => 'On Time Express',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'zTWXd4tbPD5w',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/On-Time-Chexiya.png'
        ]);

        $user->company()->create([
            'name' => 'On Time Express',
            'country' => 'Чехия',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-6',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/On-Time-Chexiya.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // TPC
        $user = User::create([
            'full_name' => 'TPC',
            'login' => 'tpc',
            'name' => 'TPC',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'sTli49CjQdNr',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Tpc-qora.png'
        ]);

        $user->company()->create([
            'name' => 'On Time Express',
            'country' => 'Литва',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-10',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Tpc-qora.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // DLI
        $user = User::create([
            'full_name' => 'DLI',
            'login' => 'dli',
            'name' => 'DLI',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'U0FK5R5Arq6f',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/DLI.png'
        ]);

        $user->company()->create([
            'name' => 'DLI',
            'country' => 'Пакистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-12',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/DLI.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // ZHEJIANG
        $user = User::create([
            'full_name' => 'ZHEJIANG',
            'login' => 'zhejiang',
            'name' => 'ZHEJIANG',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'PeGjG0PjkD5k',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Zhejiang_new.png'
        ]);

        $user->company()->create([
            'name' => 'ZHEJIANG',
            'country' => 'Китай',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-13',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Zhejiang_new.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // AmoKarwon
        $user = User::create([
            'full_name' => 'AmoKarwon',
            'login' => 'amokarwon',
            'name' => 'AmoKarwon',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'UriPQdx8pen7',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Amo-Karwan.png'
        ]);

        $user->company()->create([
            'name' => 'AmoKarwon',
            'country' => 'Авганистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2024-12-16',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Amo-Karwan.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // HemiGroup
        $user = User::create([
            'full_name' => 'HemiGroup',
            'login' => 'hemigroup',
            'name' => 'HemiGroup',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'UriPQdx8pen7',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Hemi.png'
        ]);

        $user->company()->create([
            'name' => 'HemiGroup',
            'country' => 'Латвия',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-12-17',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Hemi.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // FMD
        $user = User::create([
            'full_name' => 'FMD',
            'login' => 'fmd',
            'name' => 'FMD',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'nr62NSR7Wh1f',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/FMD.png'
        ]);

        $user->company()->create([
            'name' => 'FMD',
            'country' => 'Турция',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-2-22',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/FMD.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // Neptune Logistics Group
        $user = User::create([
            'full_name' => 'Neptune Logistics Group',
            'login' => 'neptune',
            'name' => 'Neptune Logistics Group',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'uVcWpS91zjSg',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Neptun.png'
        ]);

        $user->company()->create([
            'name' => 'Neptune Logistics Group',
            'country' => 'Китай',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-3-1',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Neptun.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // CMS
        $user = User::create([
            'full_name' => 'CMS',
            'login' => 'cms',
            'name' => 'CMS',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => '20b1WsZmUVzv',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/CMS.png'
        ]);

        $user->company()->create([
            'name' => 'CMS',
            'country' => 'Румыния',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-3-25',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/CMS.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // Jahanta
        $user = User::create([
            'full_name' => 'Jahanta',
            'login' => 'jahanta',
            'name' => 'Jahanta',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'L8cb4sc7xPNn',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Jahanta.png'
        ]);

        $user->company()->create([
            'name' => 'Jahanta',
            'country' => 'Иран',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-4-13',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Jahanta.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // Trans Global Logistics
        $user = User::create([
            'full_name' => 'Trans Global Logistics',
            'login' => 'transglobal',
            'name' => 'Trans Global Logistics',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'cxE1jeTp2fck',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Trans-Global-Logistics.png'
        ]);

        $user->company()->create([
            'name' => 'Trans Global Logistics',
            'country' => 'Кыргызстан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-4-17',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Trans-Global-Logistics.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // MLS-Trans
        $user = User::create([
            'full_name' => 'MLS-Trans',
            'login' => 'mlstrans',
            'name' => 'MLS-Trans',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'pH9N1b7aXyyP',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/MLS-Trans.png'
        ]);

        $user->company()->create([
            'name' => 'MLS-Trans',
            'country' => 'Узбекистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-4-20',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/MLS-Trans.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // One Time Express
        $user = User::create([
            'full_name' => 'One Time Express',
            'login' => 'onetimeexpresstur',
            'name' => 'One Time Express',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'SMNg8pshlnkT',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/On-Time-Turkiya.png'
        ]);

        $user->company()->create([
            'name' => 'One Time Express',
            'country' => 'Турция',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-4-22',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/On-Time-Turkiya.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // Getransit
        $user = User::create([
            'full_name' => 'Getransit',
            'login' => 'getransit',
            'name' => 'Getransit',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'Y8LYCGI8BzG2',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Getransit (2).png'
        ]);

        $user->company()->create([
            'name' => 'Getransit',
            'country' => 'Грузия',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-5-18',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Getransit (2).png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // BayKerwen
        $user = User::create([
            'full_name' => 'BayKerwen',
            'login' => 'baykerwen',
            'name' => 'BayKerwen',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => 'sOMv5dC44M0r',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Bay-Kerwen.png'
        ]);

        $user->company()->create([
            'name' => 'BayKerwen',
            'country' => 'Туркменистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-5-18',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Bay-Kerwen.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // Tylla Nal
        $user = User::create([
            'full_name' => 'Tylla Nal',
            'login' => 'tyllanal',
            'name' => 'Tylla Nal',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => '7pwQxdExnZM4',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Tylla-Nal.png'
        ]);

        $user->company()->create([
            'name' => 'Tylla Nal',
            'country' => 'Туркменистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-5-18',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Tylla-Nal.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

        // ASR Cargo
        $user = User::create([
            'full_name' => 'ASR Cargo',
            'login' => 'asrcargo',
            'name' => 'ASR Cargo',
            'email' => null,
            'role_id' => Role::FORWARDED,
            'password' => '6M7q8EHrnByt',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/ASR.png'
        ]);

        $user->company()->create([
            'name' => 'ASR Cargo',
            'country' => 'Узбекистан',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-5-6',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/ASR.png',
            'status_id' => 2,
            'is_partner' => true,
        ]);

        // SERHAT
        $user = User::create([
            'full_name' => 'SERHAT',
            'login' => 'serhat',
            'name' => 'SERHAT',
            'email' => null,
            'role_id' => Role::LOGISTIC,
            'password' => 'Djl2VZgypO6o',
            'phone' => null,
            'avatar' => '/storage/avatars/2025-05-18/Serhat.png'
        ]);

        $user->company()->create([
            'name' => 'SERHAT',
            'country' => 'Турция',
            'city' => '...',
            'address' => '...',
            'website' => null,
            'description' => '...',
            'work_start_date' => '2025-5-12',
            'employees_count' => 10,
            'avatar' => '/storage/avatars/2025-05-18/Serhat.png',
            'status_id' => 1,
            'is_partner' => true,
        ]);

    }
}
