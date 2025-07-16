import cv2
import os

# Membuka webcam
camera = 0
video = cv2.VideoCapture(camera, cv2.CAP_DSHOW)

# Algoritma FR
faceDeteksi = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

# Mengambil id dari pengguna
id = input('Id : ')
a = 0

# Pastikan folder Dataset ada
dataset_folder = 'Dataset'
if not os.path.exists(dataset_folder):
    os.makedirs(dataset_folder)

while True:
    a += 1
    check, frame = video.read()

    if not check:
        print("Couldn't read frame")
        break

    # Membuat mode pengambilan gambar pada scan menjadi Gray (abu-abu)
    abu = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # Mendeteksi wajah
    wajah = faceDeteksi.detectMultiScale(abu, scaleFactor=1.1, minNeighbors=5)

    for (x, y, w, h) in wajah:
        # Membuat file foto ke folder Dataset/ dengan identifikasi Id dan perulangan a
        file_path = os.path.join(dataset_folder, f'User.{str(id)}.{str(a)}.jpg')
        print("Saving image to:", file_path)
        cv2.imwrite(file_path, abu[y:y + h, x:x + w])
        # Mengenali bentuk wajah (kotak warna hijau di wajah)
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)

    # Nama Window
    cv2.imshow("Face Recognition Window", frame)

    # Perulangan dilakukan hingga 30 pengambilan foto
    if a > 29:
        break

# Cam berhenti
video.release()
cv2.destroyAllWindows()
