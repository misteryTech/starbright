<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Barcode Reader with Line Detection</title>
  
  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Main CSS -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />

  <!-- Html5-QRCode Library -->
  <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>

  <style>
    #qr-reader {
      width: 300px;
      margin: auto;
      display: none;
      position: relative;
    }

    #canvas-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 10;
      pointer-events: none;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 text-center">
          <button id="open-qr-reader" class="btn btn-primary">
            <i class="fa fa-qrcode"></i> Open Barcode Scanner
          </button>
          <div id="qr-reader">
            <canvas id="canvas-overlay"></canvas>
          </div>
          <p id="qr-result" class="mt-3 text-success" style="display: none;"></p>
        </div>
      </div>
    </div>
  </main>

  <script>
    document.getElementById('open-qr-reader').addEventListener('click', () => {
      const qrReader = document.getElementById('qr-reader');
      const qrResult = document.getElementById('qr-result');
      const canvasOverlay = document.getElementById('canvas-overlay');
      const button = document.getElementById('open-qr-reader');
      const context = canvasOverlay.getContext('2d');

      let isBarcodeDetected = false;
      let html5QrCode;

      if (qrReader.style.display === 'none') {
        qrReader.style.display = 'block';
        button.innerHTML = '<i class="fa fa-stop"></i> Stop Barcode Scanner';

        html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
          { facingMode: "environment" },
          { fps: 10, qrbox: { width: 300, height: 300 } },
          (decodedText) => {
            html5QrCode.stop();
            qrReader.style.display = 'none';
            qrResult.style.display = 'block';
            qrResult.textContent = `Barcode Result: ${decodedText}`;
            button.innerHTML = '<i class="fa fa-qrcode"></i> Open Barcode Scanner';
          },
          (errorMessage) => {
            // Analyze video feed for line patterns
            const video = document.querySelector('#qr-reader video');
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;

            // Line detection logic
            isBarcodeDetected = detectLines(data, canvas.width, canvas.height);

            // Visualize line detection
            if (isBarcodeDetected) {
              context.clearRect(0, 0, canvasOverlay.width, canvasOverlay.height);
              context.strokeStyle = 'red';
              context.lineWidth = 2;
              context.strokeRect(50, 50, 200, 200); // Example overlay
            }
          }
        ).catch(err => console.error("Error initializing QR scanner:", err));
      } else {
        qrReader.style.display = 'none';
        qrResult.style.display = 'none';
        button.innerHTML = '<i class="fa fa-qrcode"></i> Open Barcode Scanner';
        if (html5QrCode) html5QrCode.stop();
      }
    });

    // Simple line detection function
    function detectLines(data, width, height) {
      let count = 0;

      for (let y = 0; y < height; y += 10) {
        for (let x = 0; x < width; x += 10) {
          const index = (y * width + x) * 4;
          const r = data[index];
          const g = data[index + 1];
          const b = data[index + 2];
          const brightness = (r + g + b) / 3;

          if (brightness < 50) count++; // Dark pixel
        }
      }

      // Threshold for barcode detection
      return count > 500;
    }
  </script>
</body>

</html>
