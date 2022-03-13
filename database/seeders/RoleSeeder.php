<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $examples = [
            'admin',
            'receiver',
            'surveyor'
        ];

        foreach ($examples as $example) {
            $role = Role::create([
                'name' => $example,
            ]);
        }
    }
}
