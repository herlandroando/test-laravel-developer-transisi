## Bagian 1 - PHP Dasar

Ada tiga file yaitu:

### File 1.php
**Soal:**
Nilai ujian sebuah kelas tersimpan dalam sebuah string berikut :
$nilai = “72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86”;
Buatlah sebuah PHP script untuk menentukan (1) nilai rata-rata, (2) 7 nilai tertinggi, (3) 7 nilai terendah dari nilai-nilai di atas.

**Ringkasan:**
Saya memanfaatkan fungsi array bawaan dari PHP. Untuk 7 nilai terendah dan tertinggi saya mensorting terlebih dahulu setelah itu saya potong dengan array_slice().

### File 2.php
**Soal:**
Buatlah sebuah fungsi dalam PHP untuk menentukan jumlah huruf kecil dalam sebuah string.
Contoh : bila fungsi diberikan input “TranSISI” maka akan menghasilkan output : “TranSISI” mengandung 3 buah huruf kecil.

**Ringkasan:**
Saya menggunakan expression match: "/[^a-z]+/" //Kecuali huruf a-z dicek setiap karakter hingga seterusnya Untuk menghapus huruf-huruf besar. Jika karakter dari kalimat yang diisi sesuai expression match maka akan dihapus. Setelah proses menghapus selesai, dihitunglah karakter yang tersisa.

### File 3.php
Buatlah sebuah fungsi dalam PHP untuk membentuk unigram, bigram, trigram dari sebuah string.
Contoh : bila fungsi diberikan input “Jakarta adalah ibukota negara Republik Indonesia”, maka akan menghasilkan output :
- Unigram : jakarta, adalah, ibukota, negara, republik, indonesia
- Bigram : jakarta adalah, ibukota negara, republik indonesia
- Trigram : jakarta adalah ibukota, negara republik indonesia

**Ringkasan:**
Saya pertama kali mendengar N-Gram dari soal ini dan saya melakukan riset terlebih dahulu. Saya melihat hasil dari soal dan beberapa contoh hasil dari internet sedikit berbeda. Namun saya mengikuti contoh hasil dari internet untuk hasil dari kode ini.
Referensi: https://www.analyticsvidhya.com/blog/2021/09/what-are-n-grams-and-how-to-implement-them-in-python/
