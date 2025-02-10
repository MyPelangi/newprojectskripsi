from flask import Flask, request, jsonify
import torch
import cv2
import numpy as np
from PIL import Image
from flask import render_template
from flask_cors import CORS
import sys
sys.path.append("D:/laravel8/newprojectskripsi/flaskapi/yolov9")

# Load YOLOv9 model
model = torch.hub.load('yolov9', 'custom', path='best.pt', source='local')

app = Flask(__name__)
CORS(app)

def process_image(image_file, view):
    """Process image and get YOLO predictions based on the view."""
    image = Image.open(image_file).convert('RGB')
    results = model(image)
    detections = results.pandas().xyxy[0]  # Get results as DataFrame
    
    # Initialize default response
    output = {
        "status": "invalid",
        "handlebar": None,
        "saddle": None,
        "pedal": None,
        "front_wheel": None,
        "rear_wheel": None
    }
    
    # Define required labels based on view
    view_labels = {
        "tampak_depan": ["handlebar", "saddle", "pedal", "front_wheel"],
        "tampak_kiri": ["handlebar", "saddle", "pedal", "front_wheel", "rear_wheel"],
        "tampak_kanan": ["handlebar", "saddle", "pedal", "front_wheel", "rear_wheel"],
        "tampak_belakang": ["handlebar", "saddle", "pedal", "rear_wheel"]
    }
    
    required_labels = view_labels.get(view, [])
    
    # Check detections
    for label in required_labels:
        detected = detections[detections['name'] == label]
        if not detected.empty:
            confidence = round(detected['confidence'].max() * 100, 2)
            output[label] = True
            output[f"{label}_confidence"] = confidence
    
    # Set status to valid if all required parts are detected
    if all(output[label] for label in required_labels):
        output["status"] = "valid"
    
    return output

# @app.route('/')
# def index():
#     return render_template('index.html')

@app.route('/predict', methods=['POST'])
def predict():
    if 'tampak_depan' not in request.files or \
       'tampak_kiri' not in request.files or \
       'tampak_kanan' not in request.files or \
       'tampak_belakang' not in request.files:
        return jsonify({"success": False, "message": "Semua gambar harus diunggah."}), 400
    
    images = {
        "tampak_depan": request.files['tampak_depan'],
        "tampak_kiri": request.files['tampak_kiri'],
        "tampak_kanan": request.files['tampak_kanan'],
        "tampak_belakang": request.files['tampak_belakang']
    }
    
    predictions = {view: process_image(img, view) for view, img in images.items()}
    
    return jsonify({"success": True, "predictions": predictions})

if __name__ == '__main__':
    app.run(debug=True)
