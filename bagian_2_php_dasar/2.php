<?php

/**
 * @todo
 * Buatlah sebuah fungsi “enkripsi”, yang apabila diberikan input DFHKNQ akan memberikan output EDKGSK
 * Note:
 * Mengikuti soal tanpa spasi jadi program ini akan dijalankan tanpa enkripsi spasi.
 *
 * @author Herlandro T. <herlandrotri@gmail.com>
 */

/**
 * Enkripsi setiap karakter pada kalimat
 *
 * @param string $kalimat
 * @return void
 */
function enkripsi($kalimat)
{
    //Exception ketika spasi dimasukkan
    if (preg_match('/\s+/', $kalimat)) {
        echo "Mohon tidak menggunakan spasi.";
        exit();
    }
    //Inisialisasi variabel konfigurasi
    $jumlah_karakter    = strlen($kalimat);
    $karakter_kalimat   = str_split($kalimat);
    $tipe_huruf         = "kecil";

    //Perulangan untuk enkripsi setiap karakter
    for ($i = 1; $i <= $jumlah_karakter; $i++) {
        $ascii = ord($karakter_kalimat[$i - 1]); //Mengubah karakter menjadi nilai ASCII dari karakter tersebut.

        //Mengecek tipe karakter apakah huruf besar atau kecil
        if ($ascii >= 97 && $ascii <= 122) {
            $tipe_huruf = "kecil";
        } else {
            $tipe_huruf = "besar";
        }

        //Jika ganjil maka nilai ASCII akan ditambah n+1. Jika genap maka nilai ASCII akan dikurang n+1
        if ($i % 2 == 0) {
            $ascii -= $i;
        } else {
            $ascii += $i;
        }

        //Membatasi nilai ASCII agar tidak melewati huruf alfabet.
        if ($tipe_huruf === "kecil") {
            if ($ascii < 97) {
                $ascii = 123 - (97 - $ascii);
            } else if ($ascii > 122) {
                $ascii = 96 + ($ascii - 122);
            }
        } else {
            if ($ascii < 65) {
                $ascii = 91 - (65 - $ascii);
            } else if ($ascii > 90) {
                $ascii = 64 + ($ascii - 90);
            }
        }

        //nilai ASCII yang telah diubah tadi dikembalikan ke bentuk hurufnya.
        $karakter_kalimat[$i - 1] = chr($ascii);
    }
    //Menggabungkan hasil perubahan karakter tadi yang awalnya array menjadi string.
    return implode("", $karakter_kalimat);
}

$kalimat = readline("Kata yang ingin dienkripsi (Tanpa Spasi):");
echo "Hasil: " . enkripsi($kalimat);
echo PHP_EOL;

/**
 * Ringkasan:
 * Enkripsi yang saya pahami pada soal memakai enkripsi dengan cara:
 *
 * nomor huruf + (n+1) // + untuk n+1 = nilai ganjil
 * nomor huruf - (n+1) // - untuk n-1 = nilai genap
 *
 * nomor huruf disini saya memakai nomor ASCII dari karakter tersebut.
 * n+1 adalah perulangan dari setiap huruf pada kata yang dimasukkan pengguna.
 *
 * Pada kode diatas saya juga membatasi ketika nomor huruf ASCII melewati huruf alfabet dan mengubahnya tetap ke nomor huruf alfabet.
 * ASCII 65-90 untuk huruf kecil.
 * ASCII 97-122 untuk huruf besar.
 */