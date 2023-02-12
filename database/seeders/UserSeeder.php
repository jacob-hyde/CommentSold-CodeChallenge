<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->streamCsvData(storage_path('seeder-data/users.csv'), function (array $userData) {
            unset($userData['password_hash']);;
            $userData['password'] = Hash::make($userData['password_plain']);
            unset($userData['password_plain']);
            User::updateOrCreate(['email' => $userData['email']], $userData);
        });
    }
}
