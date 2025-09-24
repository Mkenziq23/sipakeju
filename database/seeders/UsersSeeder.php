<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin dan Psikologi
        User::create([
            'name' => 'Muhammad Ziqqi Pramudia',
            'username' => 'ziqqi',
            'email' => 'psikolog@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'psikologi',
            'client_code' => null,
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'admin',
            'client_code' => null,
        ]);

        User::create([
            'name' => 'asisten1',
            'username' => 'asisten1',
            'email' => 'asisten1@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'asisten1',
            'client_code' => null,
        ]);
        User::create([
            'name' => 'asisten2',
            'username' => 'asisten2',
            'email' => 'asisten2@gmail.com',
            'password' => bcrypt('pass'),
            'role' => 'asisten2',
            'client_code' => null,
        ]);

        // Data Pasien / Client
        $names = [
            "Nauval Arif", "Danu Ahmad Maulana", "Mochamad yoga kurniawan", "Septa Daeng Indar Kurniawan", "Mister han",
            "Yunan", "Muhammad Maulana Akbar", "Juan", "Ananda putri", "Hajratul Aulia", "mia", "Novieta Ismiyanti", "Rama",
            "Naya", "Iko Raga", "Suri Aridarma", "jeje", "Ulya", "Lulu", "David", "Yudha", "Nono", "Awan","Popo", "Setya", "Rino",
            "Ramadani", "Tio", "SANUR", "Fahri", "Fajri", "zami", "Ari", "satrio", "Ramadan", "Agus", "Naim", "Farell", 
            "Adzar Aldante", "Ambon", "Fuyu", "Fuiba", "Amboni", "muji", "bagus prasetyo", "Gibran", "Gege", "Kafa",
            "Febri", "Liana", "Bionen", "Reza", "Sadad", "Rico"
        ];

        $usedUsernames = [];
        $usedClientCodes = [];

        foreach ($names as $name) {
            // Buat username dari nama (lowercase tanpa spasi)
            $baseUsername = Str::slug($name, '');
            $username = $baseUsername;

            // Pastikan tidak ada duplikat username
            $i = 1;
            while (in_array($username, $usedUsernames) || User::where('username', $username)->exists()) {
                $username = $baseUsername . $i;
                $i++;
            }
            $usedUsernames[] = $username;

            // Email dari username
            $email = $username . '@gmail.com';

            // Generate client_code unik
            do {
                $clientCode = 'CLT-' . strtoupper(Str::random(6));
            } while (in_array($clientCode, $usedClientCodes) || User::where('client_code', $clientCode)->exists());
            $usedClientCodes[] = $clientCode;

            User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => bcrypt('pass'), // Jangan lupa bcrypt password
                'role' => 'client',
                'client_code' => $clientCode,
            ]);
        }
    }
}
