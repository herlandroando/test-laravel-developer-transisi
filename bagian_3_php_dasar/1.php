<?php

/**
 * @todo
 * Diketahui sebuah array berikut :
 * $arr = [
 *  ['f', 'g', 'h', 'i'],
 *  ['j', 'k', 'p', 'q'],
 *  ['r', 's', 't', 'u']
 * ];
 * Buatlah sebuah fungsi dalam PHP untuk melakukan pencarian kata dalam array di atas.
 *
 * @author Herlandro T. <herlandrotri@gmail.com>
 */

//Inisialisasi array.
$arr = [
    ['f', 'g', 'h', 'i'],
    ['j', 'k', 'p', 'q'],
    ['r', 's', 't', 'u']
];

/**
 * Pencarian pattern teks yang diberikan dari array yang telah di definisikan.
 *
 * @param array $arr Array yang telah di definisikan
 * @param string $text Teks pattern
 * @return bool
 */
function cari($arr, $text)
{
    echo "'{$text}' Valid: ";
    $char_text = str_split($text);

    //Awal mulai validasi pattern untuk karakter pertama.
    $pattern = initCariCharArray($arr, $char_text[0]);
    //Jika pattern tidak ada pada karakter pertama maka fungsi akan mengembalikan nilai false
    if (empty($pattern)) {
        return false;
    }

    //Mengumpulkan karakter pada pattern yang tersedia.
    $pattern_chars = array_keys($pattern);
    //Perulangan untuk validasi pattern setiap karakter pada teks.
    foreach ($char_text as $key => $char) {
        //Melewati karakter pertama karena telah di validasi.
        if ($key === 0) {
            continue;
        }
        //Jika karakter ke-n pada perulangan ada pada karakter pattern, maka set pattern baru untuk karakter ke-n
        if (in_array($char, $pattern_chars)) {
            $pattern = setCharPattern($arr, $pattern[$char]);
            $pattern_chars = array_keys($pattern);
        }
        //Jika karakter ke-n pada perulangan tidak ada pada karakter pattern, maka fungsi akan mengembalikan nilai false
        else {
            return false;
        }
    }
    //Jika semua telah tervalidasi maka nilai true akan dikembalikan.
    return true;
}

/**
 * Set pattern karakter yang diberikan
 *
 * @param array $arr Array yang telah didefinisikan
 * @param array $key Nilai key (Parent dan Child) dari karakter yang dipilih
 * @return array
 */
function setCharPattern($arr, $key)
{
    // var_dump($key);
    list($parent, $child) = $key;
    $char_pattern = [];
    //Set pattern karakter untuk sisi kiri
    $new_key = $child - 1;
    if ($new_key >= 0) {
        $selected_char = $arr[$parent][$new_key];
        $char_pattern[$selected_char] = [$parent, $new_key];
    }
    //Set pattern karakter untuk sisi kanan
    $new_key = $child + 1;
    if ($new_key <= 3) {
        $selected_char = $arr[$parent][$new_key];
        $char_pattern[$selected_char] = [$parent, $new_key];
    }
    //Set pattern karakter untuk sisi atas
    $new_key = $parent - 1;
    if ($new_key >= 0) {
        $selected_char = $arr[$new_key][$child];
        $char_pattern[$selected_char] = [$new_key, $child];
    }
    //Set pattern karakter untuk sisi bawah
    $new_key = $parent + 1;
    if ($new_key <= 2) {
        $selected_char = $arr[$new_key][$child];
        $char_pattern[$selected_char] = [$new_key, $child];
    }
    return $char_pattern;
}

/**
 * Inisialisasi validasi karakter awal
 *
 * @param array $arr Array yang telah didefinisikan
 * @param array $char Karakter awal
 * @return array|false
 */
function initCariCharArray($arr, $char)
{
    $result = [];
    foreach ($arr as $key => $value) {
        $key_value = array_search($char, $value);
        if ($key_value !== false) {
            $result = [$key, $key_value];
        }
    }
    if (empty($result)) {
        return false;
    } else {
        return setCharPattern($arr, $result);
    }
}

echo "Validasi pattern huruf dari array:", PHP_EOL;
echo "['f', 'g', 'h', 'i']
['j', 'k', 'p', 'q']
['r', 's', 't', 'u']", PHP_EOL;
var_dump(cari($arr, "fghi"));
var_dump(cari($arr, "fghp"));
var_dump(cari($arr, 'fjrstp'));
var_dump(cari($arr, 'fghq'));
var_dump(cari($arr, 'fst'));
var_dump(cari($arr, 'pqr'));
var_dump(cari($arr, 'fghh'));
$text = readline("Masukkan pattern huruf: ");
var_dump(cari($arr, $text));

/**
 * Ringkasan:
 * Dari semua soal PHP dasar mungkin ini yang paling saya suka karena pattern untuk validasi hurufnya
 * antara atas, bawah, kiri, dan kanan dari array multidimensional tersebut layaknya bermain game Snake.
 *
 * Saya menggunakan fungsi buatan sendiri untuk proses validasi pattern dan pencarian karakter.
 */
