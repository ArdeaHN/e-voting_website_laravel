<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Countdown; // Pastikan Anda mengimpor model Countdown

class CountdownController extends Controller
{
    public function index()
{
    // Misalnya, mengambil data $targetDate dari tabel countdowns
    $countdown = Countdown::latest()->first(); // Mengambil data terbaru, sesuaikan sesuai struktur database Anda

    if (!$countdown) {
        $targetDate = null; // Atur default jika data tidak ditemukan
    } else {
        $targetDate = $countdown->target_date; // Sesuaikan dengan nama kolom yang sesuai di tabel countdowns
    }

    return view('voter.countdown', [
        'title' => 'Countdown Page',
        'targetDate' => $targetDate,
    ]);
}
}
