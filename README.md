# 🧠 Sistem Pakar Identifikasi Kecenderungan Perilaku Judi Online  
*(Metode Certainty Factor Berbasis Web)*

Proyek ini merupakan **sistem pakar berbasis web** yang dirancang untuk membantu mengidentifikasi **kecenderungan perilaku kecanduan judi online** menggunakan **metode Certainty Factor (CF)**.  
Sistem ini dapat digunakan untuk melakukan analisis berdasarkan gejala yang dialami pengguna, menghitung tingkat kecenderungan, serta memberikan solusi atau rekomendasi tindak lanjut.

---

## 🚀 Fitur Utama
- ✅ **Multi Role Login (5 Role Pengguna)**  
  - **Admin** → Mengelola data sistem, pengguna, gejala, aturan, dan solusi.  
  - **Psikolog** → Melihat hasil diagnosa pengguna, memberikan rekomendasi tambahan.  
  - **Asisten 1 & Asisten 2** → Membantu psikolog/admin dalam manajemen data dan verifikasi diagnosa.  
  - **Client (Pengguna)** → Melakukan diagnosa berdasarkan gejala yang dialami.  
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
| **Psikolog** | Melihat, Memberikan bobot pernyataan, menganalisis, dan memberikan rekomendasi pada hasil diagnosa. |
| **Asisten 1** | Membantu mengelola data diagnosa dan input gejala. |
| **Asisten 2** | Membantu psikolog/admin dalam memvalidasi hasil diagnosa. |
| **Client** | Mengisi form diagnosa, serta mendapatkan solusi. |

---

## 🖼️ Tampilan Sistem

### 🔹 Halaman Beranda
![Halaman Beranda](docs/images/beranda.png)

### 🔹 Form Diagnosa (Input Gejala)
![Form Diagnosa](docs/images/form-diagnosa.png)

### 🔹 Hasil Analisis Diagnosa
![Hasil Analisis](docs/images/hasil-diagnosa.png)

### 🔹 Dashboard Admin (Manajemen Gejala & Solusi)
![Dashboard Admin](docs/images/dashboard.png)

> 📌 Catatan: Simpan semua screenshot di folder `docs/images/` agar rapi di repositori.  

---

## 🛠️ Teknologi yang Digunakan
- **Backend**: [Laravel 12](https://laravel.com/)  
- **Frontend**: Blade Template, Bootstrap/Tailwind CSS  
- **Database**: MySQL / MariaDB  
- **Authentication & Role Management**: Laravel Breeze / Jetstream + Middleware  

---

## ⚙️ Instalasi & Penggunaan

### 1. Clone Repository
```bash
git clone https://github.com/username/nama-repositori.git
cd nama-repositori
