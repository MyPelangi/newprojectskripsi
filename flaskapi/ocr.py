from flask import Blueprint, request, jsonify
import google.generativeai as genai
from werkzeug.utils import secure_filename
from PIL import Image
import os

ocr_bp = Blueprint('ocr', __name__)

UPLOAD_FOLDER = "uploads"
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

API_KEY = "AIzaSyBM1DTjiov1pyZr3hTLdSuCT0winGNV0Rw"
genai.configure(api_key=API_KEY)

def ocr_gemini(image_path):
    """Gunakan Google Gemini untuk membaca nama dari KTP/invoice"""
    image = Image.open(image_path)

    prompt_text = """
    Bacalah gambar yang saya berikan dan ekstrak **hanya nama** yang ada dalam dokumen.
    - Jika ini adalah **KTP**, ekstrak nama pemilik KTP.
    - Jika ini adalah **invoice**, ekstrak nama pembeli sepeda.
    - Jangan berikan informasi lain selain nama.
    - Hasilkan output dalam format teks biasa, misalnya: `Anjani Putri`.
    """

    model = genai.GenerativeModel("gemini-1.5-flash")
    response = model.generate_content([prompt_text, image])

    return response.text.strip()

@ocr_bp.route('/ocr', methods=['POST'])
def ocr():
    """Melakukan OCR dan menyimpan file hanya jika valid"""

    id_pengajuan = request.form.get('id_pengajuan')
    if not id_pengajuan:
        return jsonify({"success": False, "message": "ID pengajuan tidak ditemukan."}), 400

    # Ambil file lama jika tidak ada yang baru diunggah
    ktp_path = request.form.get('ktp_path')
    invoice_path = request.form.get('invoice_path')

    if 'ktp' in request.files:
        ktp = request.files['ktp']
        ktp_path = os.path.join(UPLOAD_FOLDER, secure_filename(ktp.filename))
        ktp.save(ktp_path)

    if 'invoice' in request.files:
        invoice = request.files['invoice']
        invoice_path = os.path.join(UPLOAD_FOLDER, secure_filename(invoice.filename))
        invoice.save(invoice_path)

    # Pastikan setidaknya salah satu file tersedia
    if not ktp_path or not invoice_path:
        return jsonify({"success": False, "message": "KTP atau Invoice tidak ditemukan, unggah ulang."}), 400

    # Jalankan OCR
    nama_ktp = ocr_gemini(ktp_path)
    nama_invoice = ocr_gemini(invoice_path)

    if nama_ktp.lower() == nama_invoice.lower():
        status = "valid"
        message = "Nama KTP dan Invoice sesuai. Dokumen disimpan."
    else:
        status = "invalid"
        message = (
            f"Nama KTP dan Invoice tidak cocok!\n"
            f"📌 Nama pada KTP: **{nama_ktp}**\n"
            f"📌 Nama pada Invoice: **{nama_invoice}**\n"
            f"⚠️ Silakan unggah ulang dokumen yang benar."
        )

        # Hapus file yang salah
        try:
            if nama_ktp.lower() != nama_invoice.lower():
                if 'ktp' in request.files:  # Hapus KTP hanya jika diunggah ulang
                    os.remove(ktp_path)
                    ktp_path = None
                if 'invoice' in request.files:  # Hapus Invoice hanya jika diunggah ulang
                    os.remove(invoice_path)
                    invoice_path = None
        except FileNotFoundError:
            pass  # Jangan crash jika file tidak ditemukan

    return jsonify({
        "success": status == "valid",
        "nama_ktp": nama_ktp,
        "nama_invoice": nama_invoice,
        "status": status,
        "message": message,
        "path_ktp": ktp_path if status == "valid" else None,
        "path_invoice": invoice_path if status == "valid" else None
    })
