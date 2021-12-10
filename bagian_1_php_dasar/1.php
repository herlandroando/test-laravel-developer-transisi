<?php

/**
 * @todo
 * Nilai ujian sebuah kelas tersimpan dalam sebuah string berikut :
 * $nilai = “72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86”;
 * Buatlah sebuah PHP script untuk menentukan (1) nilai rata-rata, (2) 7 nilai tertinggi,(3) 7 nilai terendah dari nilai-nilai di atas.
 *
 * @author Herlandro T. <herlandrotri@gmail.com>
 */

// Inisialisasi Nilai
$nilai = [72, 65, 73, 78, 75, 74, 90, 81, 87, 65, 55, 69, 72, 78, 79, 91, 100, 40, 67, 77, 86];

// Hitung Nilai Rata-Rata
$jumlah_data        = count($nilai);
$jumlah_nilai_data  = array_sum($nilai);
$hasil_rata_rata    = $jumlah_nilai_data/$jumlah_data;

echo "Hasil rata-ratanya adalah {$hasil_rata_rata}";

echo PHP_EOL; //PHP_EOL untuk new line di terminal/cmd.

//Mencari 7 Nilai Tertinggi

rsort($nilai); //Sorting array secara descending
$copy_nilai     = $nilai; //Variabel nilai di arahkan ke variabel baru agar tidak mengubah variabel nilai.
$copy_nilai     = array_slice($copy_nilai, 0, 7); //Array variabel copy_nilai dipotong hingga data ke 7.

$hasil          = implode(", ", $copy_nilai); //Fungsi ini akan mengubah array tadi ke bentuk string untuk di
                                              //outputkan ke terminal/cmd.

echo "7 Nilai Tertinggi adalah {$hasil}.";

echo PHP_EOL;

//Mencari 7 Nilai Terendah

asort($nilai); //Sorting array secara ascending
//Setelahnya caranya sama seperti sebelumnya.
$copy_nilai     = $nilai;
$copy_nilai     = array_slice($copy_nilai, 0, 7);
$hasil          = implode(", ", $copy_nilai);

echo "7 Nilai Terendah adalah {$hasil}.";

echo PHP_EOL;

/**
 * Ringkasan:
 * Saya memanfaatkan fungsi array bawaan dari PHP. Untuk 7 nilai terendah dan tertinggi saya mensorting terlebih dahulu
 * setelah itu saya potong dengan array_slice().
 */