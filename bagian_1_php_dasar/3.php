<?php

/**
 * @todo
 * Buatlah sebuah fungsi dalam PHP untuk membentuk unigram, bigram, trigram dari sebuah string.
 * Contoh : bila fungsi diberikan input “Jakarta adalah ibukota negara Republik Indonesia”, maka akan menghasilkan output :
 *
 * @author Herlandro T. <herlandrotri@gmail.com>
 */

/**
 * Mengeluarkan hasil dari N-Gram sebuah kalimat
 *
 * @param string $kalimat Kalimat yang ingin di N-Gram.
 * @param int $n_gram Operasi N-Gram berapa yang ingin dilakukan.
 * @param int $total_n_gram_kalimat Total hasil perhitungan N-Gram dari kalimat yang dimasukkan
 * @return array
 */
function outputNgram($kalimat, $n_gram, $total_n_gram_kalimat)
{
    $array_kalimat  = preg_split('/\s+/', $kalimat);
    $hasil          = [];
    for ($i = 0; $i < $total_n_gram_kalimat; $i++) {
        $hasil[] = implode(" ", array_slice($array_kalimat, $i, $n_gram));
    }
    return $hasil;
}

//Inisialisasi
$nama_gram = ["Unigram", "Bigram", "Trigram"];

//Mengambil data dari input user dan dimasukkan ke variabel kalimat.
echo "Membentuk unigram, bigram, dan trigram dari sebuah kalimat.", PHP_EOL;
echo PHP_EOL;
$kalimat = readline("Masukkan kalimat: ");

//Jika user tidak memberikan input maka nilai default akan menjadi kalimat yang di input yang dimasukkan ke variabel kalimat.
if (empty($kalimat)) {
    $kalimat  = "Jakarta adalah ibukota negara Republik Indonesia";
    echo "Karena kata tidak diisi maka nilai default yaitu kata \"Jakarta adalah ibukota negara Republik Indonesia\".", PHP_EOL;
}

//Menghitung jumlah kata pada kalimat yang diinputkan
$jumlah_kata = str_word_count($kalimat, 0, "0..9");

//Melakukan operasi N-Gram
for ($n_gram = 1; $n_gram < 4; $n_gram++) {
    //Rumus untuk operasi n-gram.
    $total_n_gram_kalimat = $jumlah_kata - ($n_gram - 1);
    if ($total_n_gram_kalimat <= 0) {
        break;
    }
    echo "Hasil untuk {$nama_gram[$n_gram - 1]}:", PHP_EOL;
    echo implode(", ", outputNgram($kalimat, $n_gram, $total_n_gram_kalimat)), PHP_EOL;
    echo "-------------------------", PHP_EOL;
}

/**
 * Ringkasan:
 * Saya pertama kali mendengar N-Gram dari soal ini dan saya melakukan riset terlebih dahulu.
 * Saya melihat hasil dari soal dan beberapa contoh hasil dari internet sedikit berbeda.
 * Namun saya mengikuti contoh hasil dari internet untuk hasil dari kode ini.
 * Referensi: https://www.analyticsvidhya.com/blog/2021/09/what-are-n-grams-and-how-to-implement-them-in-python/
 *
 */