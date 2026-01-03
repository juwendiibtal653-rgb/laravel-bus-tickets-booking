<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID booking yang sudah memiliki pembayaran agar tidak error duplikat
        $existingBookingIds = DB::table('payments')->pluck('booking_id')->toArray();

        // Ambil booking yang belum memiliki data pembayaran
        // Sesuaikan dengan Controller: Gunakan Model Booking dan load relasi ride
        $bookings = Booking::whereNotIn('id', $existingBookingIds)->with('ride')->get();

        if ($bookings->isEmpty()) {
            $this->command->info('Tidak ada data booking baru. Seeder pembayaran dilewati.');
            return;
        }

        $payments = [];

        foreach ($bookings as $booking) {
            // Random status untuk simulasi data (paid/pending) sesuai tampilan index
            $status = rand(0, 1) ? 'paid' : 'pending';
            
            // Jika paid, ada tanggalnya. Jika pending, null.
            $paymentDate = $status === 'paid' ? Carbon::now()->subDays(rand(0, 14)) : null;

            // Ambil harga dari relasi ride (seperti logika di aplikasi), fallback ke random jika null
            $amount = $booking->ride->price ?? (rand(10, 50) * 10000);

            // Buat data pembayaran dummy untuk setiap booking
            $payments[] = [
                'booking_id'   => $booking->id,
                'amount'       => $amount,
                'status'       => $status,
                'payment_date' => $paymentDate,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ];
        }

        DB::table('payments')->insert($payments);
        $this->command->info('Berhasil memasukkan ' . count($payments) . ' data pembayaran.');
    }
}