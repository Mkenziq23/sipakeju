import cv2
import os

# Get the directory of the current script
script_dir = os.path.dirname(os.path.abspath(__file__))

# Camera index (0 for built-in webcam, adjust accordingly)
camera = 0

# Initialize video capture
video = cv2.VideoCapture(camera, cv2.CAP_DSHOW)

# Load the pre-trained Haar cascade for face detection
face_detector = cv2.CascadeClassifier(os.path.join(script_dir, 'haarcascade_frontalface_default.xml'))

# Load the LBPH face recognizer
recognizer = cv2.face.LBPHFaceRecognizer_create()

# Specify the path to the trained model
trained_model_path = os.path.join(script_dir, 'Dataset/training.xml')

# Check if the trained model file exists
if not os.path.exists(trained_model_path):
    print(f"Error: Trained model file '{trained_model_path}' not found.")
    exit()

# Try to read the trained model
try:
    recognizer.read(trained_model_path)
    print("Trained model loaded successfully.")
except cv2.error as e:
    print(f"Error reading the trained model: {e}")
    exit()

# Mapping user IDs to names
user_names = {
    1: {'Name': 'Muhammad Ziqqi Pramudia', 'Nim': '2110651038', 'Age': 20},
    2: {'Name': 'Muhammad Arifulloh', 'Nim': '2210651014', 'Age': 21},
    3: {'Name': 'Muhammad Sadad Ulinnuha', 'Nim': '2110651059', 'Age': 22},
    # Add more user entries as needed
}

while True:
    # Capture a frame from the video
    check, frame = video.read()

    if not check:
        print("Couldn't read frame")
        break

    # Convert the frame to grayscale
    gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

    # Detect faces in the grayscale frame
    faces = face_detector.detectMultiScale(gray_frame, scaleFactor=1.3, minNeighbors=5)

    for (x, y, w, h) in faces:
        # Draw a green rectangle around the detected face
        cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)

        # Extract the region of interest (ROI) from the face
        face_roi = gray_frame[y:y + h, x:x + w]

        # Recognize the face
        user_id, confidence = recognizer.predict(face_roi)

        # Get the user information based on the user ID
        user_info = user_names.get(user_id, {'Name': 'Unknown', 'Nim': 'Unknown', 'Age': 'Unknown'})

        # Extract name, NIM, and Age from the user information
        user_name = user_info['Name']
        user_nim = user_info['Nim']
        user_age = user_info['Age']

        # Organize the text to display neatly
        text_name = f"Name: {user_name}"
        text_nim = f"NIM: {user_nim}"
        text_age = f"Age: {user_age}"

        # Display the organized text on the frame
        cv2.putText(frame, text_name, (x + 10, y - 40), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 2)
        cv2.putText(frame, text_nim, (x + 10, y - 20), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 2)
        cv2.putText(frame, text_age, (x + 10, y), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 2)

    # Display the frame in a window titled "Face Recognition"
    cv2.imshow("Face Recognition", frame)

    # Check for the 'q' key to exit the loop
    key = cv2.waitKey(1)
    if key == ord('q'):
        break

# Release the video capture
video.release()

# Close all OpenCV windows
cv2.destroyAllWindows()
