<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin users
        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('adminkesatu'),
            'role' => 'admin',
            'sesi' => '00:00:00',
        ]);
        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('adminkedua'),
            'role' => 'admin',
            'sesi' => '00:00:00',
        ]);

        // Create Voter users
        $VoterData = [
            ['Ardea Himawan Nugroho', '21102076','A', '21102076@ittelkom-pwt.ac.id', '07:00:00'],
            ['Voter 2', '', 'B', 'Voter2@gmail.com', '09:00:00'],
            ['Voter 3', '', 'A', 'Voter3@gmail.com', '12:00:00'],
            ['Voter 4', '', 'B', 'Voter4@gmail.com', '14:00:00'],
            ['Voter 5', '', 'A', 'Voter5@gmail.com', '16:00:00'],
        ];

        foreach ($VoterData as $data) {
            User::create([
                'name' => $data[0],
                'NIM' => $data[1],
                'email' => $data[3],
                'password' => bcrypt('password'),
                'role' => 'Voter',
                'sesi' => $data[4],
            ]);
        }

    }
}
