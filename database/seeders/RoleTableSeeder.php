<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'viewer' => 'Viewer cannot create posts', 
            'curator' => 'Curator can create posts', 
            'moderator' => 'Moderator can remove posts', 
            'admin' => 'Admin can do all of the above and add tags'
        ];
        // Create Role from the roles array.
        foreach($roles as $role=>$description) {
            Role::factory()->state([
                'name' => $role,
                'description' => $description,
            ])->create();
        }

    }
}
