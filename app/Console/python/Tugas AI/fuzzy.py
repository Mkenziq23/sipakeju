import cv2
import pytesseract

# Konfigurasi Tesseract OCR
pytesseract.pytesseract.tesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'

def deteksi_nama_nim(image_path):
    # Baca gambar dari file
    image = cv2.imread(image_path)

    # Konversi gambar ke skala abu-abu
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Lakukan deteksi teks menggunakan Tesseract OCR
    teks = pytesseract.image_to_string(gray)

    # Proses teks untuk mengekstrak NIM dan Nama
    nim = None
    nama = None

    # Implementasikan logika ekstraksi NIM dan Nama dari teks

    # Contoh sederhana: Cari kata 'NIM' dan 'Nama' dalam teks
    if 'NIM' in teks:
        nim_index = teks.index('NIM')
        nim = teks[nim_index:nim_index + 10]  # Contoh, mengambil 10 karakter setelah 'NIM'
    
    if 'Nama' in teks:
        nama_index = teks.index('Nama')
        nama = teks[nama_index:nama_index + 20]  # Contoh, mengambil 20 karakter setelah 'Nama'

    return nim, nama

# Contoh penggunaan
gambar_path = 'path/to/your/image.jpg'
hasil_nim, hasil_nama = deteksi_nama_nim(gambar_path)

print(f"NIM: {hasil_nim}")
print(f"Nama: {hasil_nama}")
