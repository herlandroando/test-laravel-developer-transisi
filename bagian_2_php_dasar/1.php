<?php

/**
 * @todo
 * Buatlah sebuah fungsi dalam PHP, yang apabila dipanggil akan menampilkan tabel berikut. (Ada pada dokumen)
 * Note:
 * Saya membuat hitam menjadi warna light cyan agar kelihatan ketika mungkin terminal yang dipake berwarna hitam dan
 * membuat warna putih menjadi warna light yellow agar kelihatan ketika mungkin terminal yang dipake berwarna putih
 *
 * @author Herlandro T. <herlandrotri@gmail.com>
 */

//Melakukan perulangan untuk membuat tabel seperti di soal.
for ($i = 1; $i < 65; $i++) {
    //Jika nilai telah mencapai angka dari $i modulus 8 sama dengan 1 maka terminal akan membuat new line.
    if ($i % 8 === 1) {
        echo PHP_EOL;
    }
    //Jika $i modulus 3 sama dengan 0 dan $i modulus 4 sama dengan 0 maka angka akan berwarna light yellow.
    if ($i % 3 === 0 || $i % 4 === 0) {
        echo "\033[93m $i";
    }
    //Selain itu maka angka akan berwarna light green .
    else {
        echo "\033[92m $i";
    }
    //Jika nilai masih dibawah 10 maka akan ditambah spasi setelah angka agar output sejajar.
    if ($i < 10)
        echo " ";
}

/**
 * Ringkasan:
 * Saya memahami pattern dari tabel pada soal. Ketika nilai tersebut adalah hasil kelipatan dari 3 atau 4 maka
 * kolom dari nilai tersebut berwarna putih, sisanya akan diwarnai hitam. Makanya saya memakai:
 * $i % 3 === 0 || $i % 4 === 0 //Kelipatan 3 dan 4
 *
 */