## Tutorial Menggunakan Kodingan:
1. Download ZIP proyek dari GitHub.
2. Ekstrak file ke dalam folder htdocs XAMPP. Contoh lokasi: C:\xampp\htdocs\data-produk.
3. Buat Database di phpMyAdmin:
   - Jalankan XAMPP dan aktifkan: Apache dan MySQL
   - Buka phpMyAdmin dengan klik admin pada MySQL: ![Screenshot (626)2](https://github.com/user-attachments/assets/0ec71fe5-6364-46eb-a86c-2122919c51fc)
   - Buat database baru dengan nama: dataproduk.
   - Import file database (jika tersedia di folder proyek): Klik database dataproduk → Import → Pilih file .sql → Go.
4. Cek Konfigurasi Koneksi Database:
   - Buka file koneksi database, bernama koneksi.php.
   - Bagian $db = "dataproduk";
   - Lihat dan cocokkan dengan nama database yang dibuat, untuk memastikan tidak ada kesalahan penulisan.
5. Jalankan Proyek di Browser:
   - Pastikan XAMPP berjalan (Apache & MySQL aktif).
   - Buka browser dan akses proyek dengan mengetikkan: http://localhost/data-produk
   - Jika tidak ada error, seharusnya proyek berjalan normal.
