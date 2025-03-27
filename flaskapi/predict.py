from flask import Blueprint, request, jsonify
import torch
import os
from werkzeug.utils import secure_filename
from PIL import Image
import uuid
import sys
sys.path.append("D:/laravel8/newprojectskripsi/flaskapi/yolov9")

predict_bp = Blueprint('predict', __name__)

UPLOAD_FOLDER = "uploads"
os.makedirs(UPLOAD_FOLDER, exist_ok=True)  # Buat folder jika belum ada

# Load YOLOv9 model
model = torch.hub.load('yolov9', 'custom', path='best.pt', source='local')

ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

def process_image(image_path, view):
    """Process image and get YOLO predictions based on the view."""
    image = Image.open(image_path).convert('RGB')
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
    if all(output.get(label, False) for label in required_labels):
        output["status"] = "valid"

    return output

@predict_bp.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({"success": False, "message": "Tidak ada gambar yang diunggah."}), 400

    image = request.files['image']
    view = request.form.get('jenis_gambar')
    id_pengajuan = request.form.get('id_pengajuan')

    if not id_pengajuan:
        return jsonify({"success": False, "message": "id_pengajuan missing"}), 400

    if not view or view not in ["tampak_depan", "tampak_kiri", "tampak_kanan", "tampak_belakang"]:
        return jsonify({"success": False, "message": "Jenis gambar tidak valid."}), 400

    if not allowed_file(image.filename):
        return jsonify({"success": False, "message": "Format file tidak didukung."}), 400

    # Simpan gambar dengan nama aman
    filename = f"{uuid.uuid4().hex}_{secure_filename(image.filename)}"
    image_path = os.path.join(UPLOAD_FOLDER, filename)
    image.save(image_path)

    # Proses gambar untuk deteksi
    prediction = process_image(image_path, view)

    return jsonify({
        "success": True,
        "view": view,
        "id_pengajuan": id_pengajuan,
        "prediction": prediction,
        "image_path": image_path  # Path gambar yang tersimpan
    })
