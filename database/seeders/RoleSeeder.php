<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Role::ROLES as $id => $name) {
            Role::create([
                'id'    => $id,
                'name'  => $name,
                'alias' => Role::ALIASES[$id],
            ]);
        }

    }
}
