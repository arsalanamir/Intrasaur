<?php

namespace Database\Seeders;

use App\Models\OrgProfile;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'role' => 'admin',
                'email_code' => '1234',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'first_name' => 'user',
                'last_name' => 'user',
                'role' => 'user',
                'email_code' => '5678',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'first_name' => 'organizer',
                'last_name' => 'org',
                'role' => 'org',
                'email_code' => '5678',
                'email' => 'org@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            $user = User::create($value);
            if($user->role == 'user'){
                UserProfile::create([
                    'user_id' => $user->id,
                ]);
            }
            if ($user->role == 'org') {
                OrgProfile::create([
                    'user_id' => $user->id,
                ]);
            }
        }
        // \App\Models\User::factory(10)->create();
    }
}
