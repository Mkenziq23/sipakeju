# Mengimport package yang diperlukan
import cv2
import os
import numpy as np
from PIL import Image

# Membuat variabel recognizer
recognizer = cv2.face.LBPHFaceRecognizer_create()

# Specify the path to the Haar cascade file
cascade_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'haarcascade_frontalface_default.xml')

# Untuk detector menggunakan file haarcascade_frontalface_default.xml
detector = cv2.CascadeClassifier(cascade_path)

# Membuat fungsi dengan getImagesWithLabels parameter path
def getImagesWithLabels(path):
    imagePaths = [os.path.join(path, f) for f in os.listdir(path) if f.lower().endswith('.jpg')]
    faceSamples = []
    Ids = []

    # for untuk perulangan imagePath yang ada pada imagePaths
    for imagePath in imagePaths:
        try:
            # Image
            pilImage = Image.open(imagePath).convert('L')
            imageNp = np.array(pilImage, 'uint8')
            Id = int(os.path.split(imagePath)[-1].split(".")[1])
            faces = detector.detectMultiScale(imageNp)
            for (x, y, w, h) in faces:
                faceSamples.append(imageNp[y:y + h, x:x + w])
                Ids.append(Id)
        except (OSError, IOError, Image.UnidentifiedImageError) as e:
            print(f"Error processing image {imagePath}: {e}")
            continue  # Skip to the next image on error

    # return untuk mengembalikan nilai
    return faceSamples, Ids

faces, Ids = getImagesWithLabels('Dataset')
recognizer.train(faces, np.array(Ids))

# Data training disimpan di folder Dataset dengan nama file training.xml
recognizer.save('Dataset/training.xml')
