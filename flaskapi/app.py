from flask import Flask, send_from_directory
from predict import predict_bp
from ocr import ocr_bp
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

app.register_blueprint(predict_bp)
app.register_blueprint(ocr_bp)

UPLOAD_FOLDER = 'uploads'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

@app.route('/flaskapi/<filename>')
def get_image(filename):
    return send_from_directory(app.config['UPLOAD_FOLDER'], filename)

if __name__ == '__main__':
    app.run(debug=True)
