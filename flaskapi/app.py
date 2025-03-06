from flask import Flask
from predict import predict_bp
from ocr import ocr_bp
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

app.register_blueprint(predict_bp)
app.register_blueprint(ocr_bp)

if __name__ == '__main__':
    app.run(debug=True)
