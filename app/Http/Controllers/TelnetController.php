<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelnetController extends Controller
{
    public function connect()
    {
        $host = '103.60.233.10';
        $port = 2323;

        // Membuat koneksi fsockopen
        $connection = fsockopen($host, $port, $errno, $errstr);

        if (!$connection) {
            return response()->json(['error' => 'Gagal terhubung ke Telnet server.']);
        }

        // Sekarang Anda bisa melakukan sesuatu dengan koneksi Telnet, misalnya mengirim perintah.
        // Contoh: Mengirim perintah untuk mendapatkan output dari server Telnet
        $command = "ls\r\n"; // Ganti dengan perintah sesuai dengan kebutuhan Anda.
        fwrite($connection, $command);
        $output = fread($connection, 4096); // Membaca output dari Telnet server
        fclose($connection); // Menutup koneksi

        return response()->json(['output' => $output]);
    }
}
