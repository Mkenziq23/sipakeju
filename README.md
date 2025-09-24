# 🧠 Sistem Pakar Identifikasi Kecenderungan Perilaku Judi Online  
*(Metode Certainty Factor Berbasis Web)*

Proyek ini merupakan **sistem pakar berbasis web** yang dirancang untuk membantu mengidentifikasi **kecenderungan perilaku kecanduan judi online** menggunakan **metode Certainty Factor (CF)**.  
Sistem ini dapat digunakan untuk melakukan analisis berdasarkan gejala yang dialami pengguna, menghitung tingkat kecenderungan, serta memberikan solusi atau rekomendasi tindak lanjut.

---

## 🚀 Fitur Utama
- ✅ **Multi Role Login (5 Role Pengguna)**  
  - **Admin** → Mengelola data sistem, pengguna, gejala, aturan, dan solusi.  
  - **Psikolog** → Memberikan bobot pernyataan, menganalisis, dan memberikan rekomendasi pada hasil diagnosa.  
  - **Asisten 1 & Asisten 2** → Membantu psikolog/admin dalam manajemen data dan verifikasi diagnosa.  
  - **Client (Pengguna)** → Mengisi form diagnosa, melihat hasil analisis, serta mendapatkan solusi.  
- ✅ **Identifikasi Gejala** – Pengguna memilih gejala yang dialami.  
- ✅ **Perhitungan Certainty Factor (CF)** – Menghitung tingkat kecenderungan terhadap perilaku judi online.  
- ✅ **Laporan Hasil Diagnosa** – Menampilkan hasil analisis berupa persentase, kategori tingkat kecenderungan, deskripsi, dan solusi.  
- ✅ **Penyimpanan Data** – Hasil diagnosa tersimpan dalam basis data.  
- ✅ **Manajemen Basis Pengetahuan** – Admin dapat mengelola data gejala, aturan, serta solusi.  
- ✅ **Export & Cetak Hasil** – Hasil diagnosa dapat dicetak sebagai laporan.  

---

## 🔐 Autentikasi & Role
Sistem ini mendukung **multi-user role** dengan hak akses berbeda sesuai kebutuhan:  

| Role       | Hak Akses Utama |
|------------|-----------------|
| **Admin**  | CRUD data pengguna, gejala, aturan, solusi, serta manajemen sistem. |
| **Psikolog** | Memberikan bobot pernyataan, menganalisis, dan memberikan rekomendasi pada hasil diagnosa. |
| **Asisten 1** | Membantu mengelola data diagnosa dan input gejala. |
| **Asisten 2** | Membantu psikolog/admin dalam memvalidasi hasil diagnosa. |
| **Client** | Mengisi form diagnosa serta mendapatkan solusi. |

---

## 🖼️ Tampilan Sistem

### 🔹 Halaman Beranda
![Halaman Beranda](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/home.png)

### 🔹 Halaman Login
![Halaman Login](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/login.png)

### 🔹 Halaman Dashboard
![Halaman Dashboard](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/dashboard.png)

### 🔹 Halaman Range
![Halaman Range](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/range.png)

### 🔹 Halaman Pernyataan
![Halaman Pernyataan](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/pernyataan.png)

### 🔹 Halaman Tipe Kecenderungan Perilaku
![Halaman Tipe Kecenderungan Perilaku](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/tipe%20kecenderungan%20perilaku.png)

### 🔹 Halaman Basis Pengetahuan
![Halaman Basis Pengetahuan](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/basis%20pengetahuan.png)

### 🔹 Halaman Hasil Identifikasi
![Halaman Hasil Identifikasi](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/hasil%20identifikasi.png)

### 🔹 Halaman Kelola Akun
![Halaman Kelola Akun](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/kelola%20akun.png)

### 🔹 Form Data Diri (Input Data Diri)
![Form Data Diri](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/form%20data%20diri.png)

### 🔹 Form Pernyataan (Input Pernyataan)
![Form Pernyataan](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/form%20pernyataan.jpg)

### 🔹 Hasil Identifikasi
![Hasil Identifikasi](https://github.com/Mkenziq23/sipakeju/blob/main/public/imgreadme/hasil%20identifikasi.jpg)

---

## 🛠️ Teknologi yang Digunakan
- **Backend**: [Laravel 12](https://laravel.com/)  
- **Frontend**: Blade Template, Bootstrap/Tailwind CSS  
- **Database**: MySQL  
- **Authentication & Role Management**: Laravel Middleware  

---

## ⚙️ Instalasi & Penggunaan

### 1. Clone Repository
git clone https://github.com/Mckenziq23/sipakeju.git
cd nama-repositori

### 2. Install Dependency PHP
composer install

### 3. Konfigurasi File Environment
cp .env.example .env

### 4. Generate Key
php artisan key:generate

### 5. Migrasi & Seeder Database
php artisan migrate --seed

### 6. Jalankan Server
php artisan serve
