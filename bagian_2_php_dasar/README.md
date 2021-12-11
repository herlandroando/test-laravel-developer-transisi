## Bagian 2 - PHP Dasar

### File 1.php

**Soal:**
Buatlah sebuah fungsi dalam PHP, yang apabila dipanggil akan menampilkan tabel berikut. (Ada pada soal).

**Ringkasan:**
Saya membuat hitam menjadi warna light cyan agar kelihatan ketika mungkin terminal yang dipake berwarna hitam dan membuat warna putih menjadi warna light yellow agar kelihatan ketika mungkin terminal yang dipake berwarna putih

### File 2.php

Buatlah sebuah fungsi “enkripsi”, yang apabila diberikan input DFHKNQ akan memberikan output EDKGSK

Note:

Mengikuti soal tanpa spasi jadi program ini akan dijalankan tanpa enkripsi spasi.

**Ringkasan:**
Saya membuat hitam menjadi warna light cyan agar kelihatan ketika mungkin terminal yang dipake berwarna hitam dan membuat warna putih menjadi warna light yellow agar kelihatan ketika mungkin terminal yang dipake berwarna putih

Enkripsi yang saya pahami pada soal memakai enkripsi dengan cara:
nomor huruf + (n+1) // + untuk n+1 = nilai ganjil
nomor huruf - (n+1) // - untuk n-1 = nilai genap

nomor huruf disini saya memakai nomor ASCII dari karakter tersebut.
n+1 adalah perulangan dari setiap huruf pada kata yang dimasukkan pengguna.

Pada kode diatas saya juga membatasi ketika nomor huruf ASCII melewati huruf alfabet dan mengubahnya tetap ke nomor huruf alfabet.

* ASCII 65-90 untuk huruf kecil.

* ASCII 97-122 untuk huruf besar.