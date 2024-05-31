<?php

namespace Database\Seeders;

use App\Models\FileExtension;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::insert([
            [
                'id' => 1,
                'role' => 'Administrator',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'role' => 'User',
                'created_at' => now()
            ]
        ]);

        Status::insert([
            [
                'id' => 1,
                'status' => 'draft',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'status' => 'published',
                'created_at' => now()
            ],
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '',
            'avatar' => 'assets/media/svg/avatars/blank.svg',
            'role_id' => 1,
            'status' => 1,
        ]);

        FileExtension::insert([
            [
                'extension' => 'pdf',
                'type'  => 'document',
            ],
            [
                'extension' => 'jpg',
                'type' => 'image',
            ],
            [
                'extension' => 'png',
                'type' => 'image',
            ],
            [
                'extension' => 'gif',
                'type' => 'image',
            ],
            [
                'extension' => 'mp4',
                'type' => 'video',
            ],
            [
                'extension' => 'avi',
                'type' => 'video',
            ],
            [
                'extension' => 'mov',
                'type' => 'video',
            ],
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
