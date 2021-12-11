
# Bagian Laravel Dasar

  
## Inisialisasi
- `php artisan key:generate` membuat kunci untuk aplikasi laravel ini.
- `npm install && npm run dev` agar file js dan css terkompilasi dengan Laravel Mix.
- `composer dump-autoload`
## Library yang Digunakan
- Laravel UI (Bootstrap)
- Laravel Mix
- Laravel DomPDF
- Laravel Excel
- Jquery
- select2
- CropperJS
- Bootstrap Icons

## Penyelesaian
1. Aplikasi memiliki proses autentikasi untuk administrator. Gunakan database seeds untuk membuat user dengan email : admin@transisi.id dan password : transisi

**Jawaban:**
Saya telah menambahkan di [DatabaseSeeder](https://github.com/herlandroando/test-laravel-developer-transisi/blob/master/bagian_laravel_dasar/database/seeders/DatabaseSeeder.php) .

2. Aplikasi memiliki fungsionalitas CRUD untuk data companies dan employees. Gunakan Laravel Resource Controllers dengan default methods. Pada companies/employees list gunakan laravel pagination, tampilkan 5 data per halaman.

**Jawaban:**
Saya telah memakai Resource Controller dan agak kostumisasi sedikit untuk fungsi lain. Pagination juga sudah diterapkan pada halaman index (Halaman tabel) dari Employees dan Companies

3. Data companies yang disimpan adalah : Nama (wajib), email (wajib), logo (wajib, minimum 100x100 px, png, ukuran maks 2 MB), website (wajib). Simpan company logo pada folder storage/app/company.

**Jawaban:**
Hal ini telah saya terapkan namun saya memodifikasinya sedikit dan menambah fitur cropping didalamnya. Mungkin filenya akan berbentuk base64 dari sisi klien namun sudah saya kelola dan validasi filenya. File juga telah disimpan di path yang diinginkan.

4. Data employees yang disimpan adalah : Nama (wajib), Company (foreign key ke company), email (wajib), dan Gunakan database migrations untuk membuat schema yang diperlukan

**Jawaban:**
Sudah dilaksanakan untuk migrasi bisa diliat di [sini](https://github.com/herlandroando/test-laravel-developer-transisi/tree/master/bagian_laravel_dasar/database/migrations).

5. Gunakan laravel validation function menggunakan Request classes, untuk proses validasi data companies & employees.

**Jawaban:**
Companies dan Employees telah menerapkan validasi sesuai permintaan.

6. Query/eloquent dalam proses CRUD dijadikan class tersendiri (terpisah dari controller)

**Jawaban:**
Untuk hal ini saya menggunakan metode **Repository Pattern** dimana file query/eloquent terpisah dari controller sesuai dengan permintaan. Folder Repository ada [disini](https://github.com/herlandroando/test-laravel-developer-transisi/tree/master/bagian_laravel_dasar/app/Repository).

7. Aplikasi memiliki fungsionalitas export pdf untuk data employees pada setiap company, gunakan dompdf
(https://github.com/barryvdh/laravel-dompdf)!

**Jawaban:**
Saya telah menerapkan export pdf pada halaman show pada Companies secara spesifik. [Screen Shot 2021-12-11 at 07 22 02](https://user-images.githubusercontent.com/68886121/145656698-328f4ef4-e535-40cd-9183-86d70a745edb.png) Link gambar ini adalah tombol pada bulatan merah untuk ke export pdf sesuai permintaan.

8. Aplikasi memiliki fungsionalitas import excel dengan minimum 100 records data excel (chunk per 10 data insert), sertakan contoh
file import 100 records data excel dalam pengiriman hasil tes.

**Jawaban:**
Telah saya terapkan dengan bantuan library Laravel Excel. Filenya ada disini untuk [Companies](https://github.com/herlandroando/test-laravel-developer-transisi/blob/master/bagian_laravel_dasar/app/Http/Controllers/ImportCompanyController.php) dan [Employees](https://github.com/herlandroando/test-laravel-developer-transisi/blob/master/bagian_laravel_dasar/app/Http/Controllers/ImportEmployeeController.php) disini.

9. Menggunakan select2 untuk dropdown company ketika menambah employee (load data menggunakan ajax dan harus terdapat
pagination)

**Jawaban:**
Telah saya terapkan juga untuk filenya terdapat disini untuk [Sisi Klien](https://github.com/herlandroando/test-laravel-developer-transisi/blob/master/bagian_laravel_dasar/resources/js/employees.js) dan ini untuk [Sisi Server](https://github.com/herlandroando/test-laravel-developer-transisi/blob/05d5c94530bf28057b71561322b939e16c54c165/bagian_laravel_dasar/app/Http/Controllers/EmployeeController.php#L118)
