<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ride;
use Carbon\Carbon;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada data User dan Ride sebelum membuat booking
        // Kita menggunakan Model agar lebih mudah mengambil ID acak
        $users = User::all();
        $rides = Ride::all();

        if ($users->isEmpty() || $rides->isEmpty()) {
            $this->command->warn('Data User atau Ride kosong. Harap jalankan seeder User dan Ride terlebih dahulu.');
            return;
        }

        $bookings = [];

        // Buat 20 data dummy booking
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $bookings[] = [
                  'user_id'    => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'phone'      => '0812' . rand(10000000, 99999999),
                'ride_id'    => $rides->random()->id,
                'seat_id'    => rand(1, 40),
                'status'     => 'booked',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('bookings')->insert($bookings);
        $this->command->info('Berhasil memasukkan ' . count($bookings) . ' data booking.');
    }
}
