<?php

/**
 * @todo
 * Buatlah sebuah fungsi dalam PHP untuk menentukan jumlah huruf kecil dalam sebuah string.
 * Contoh : bila fungsi diberikan input “TranSISI” maka akan menghasilkan output : “TranSISI” mengandung 3 buah huruf kecil.
 *
 * @author Herlandro T. <herlandrotri@gmail.com>
 */

//Mengambil data dari input user dan dimasukkan ke variabel kata.
echo "Menghitung jumlah huruf kecil dalam sebuah string.", PHP_EOL;
$kata      = readline("Masukkan kata: ");

//Jika user tidak memberikan input maka nilai default akan menjadi kata yang di input yang dimasukkan ke variabel kata.
if (empty($kata)) {
    $word  = "TranSISI";
    echo "Karena kata tidak diisi maka nilai default yaitu kata \"TranSISI\".", PHP_EOL;
}
//Memulai menghitung jumlah huruf kecil didalam variabel kata
$replace   = preg_replace("/[^a-z]+/", "", $kata); //Filtering dan menghapus huruf besar (Uppercase) dengan expression match (PCRE Pattern)
$hasil     = strlen($replace); //Menjumlahkan semua karakter pada kata yang telah di filter tadi.

//Hasil
echo PHP_EOL;
echo "\"{$kata}\" mengandung {$hasil} buah huruf kecil.";

/**
 * Ringkasan:
 * Saya menggunakan expression match:
 * "/[^a-z]+/" //Kecuali huruf a-z dicek setiap karakter hingga seterusnya
 *
 * Untuk menghapus huruf-huruf besar. Jika karakter dari kalimat yang diisi sesuai expression match maka akan
 * dihapus. Setelah proses menghapus selesai, dihitunglah karakter yang tersisa.
 */