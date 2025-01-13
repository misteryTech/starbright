<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Soft UI Dashboard 3</title>
  
  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Main CSS -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.1.0" rel="stylesheet" />

  <!-- Html5-QRCode Library -->



  <style>
    #qr-reader {
      width: 150px;
      margin: auto;
      display: none;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">

  <?php include("sidebar.php"); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <?php include("navbar.php"); ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 text-center">
          <button id="open-qr-reader" class="btn btn-primary">
            <i class="fa fa-qrcode"></i> Open QR Code Scanner
          </button>
          <div id="qr-reader"></div>
          <p id="qr-result" class="mt-3 text-success" style="display: none;"></p>
        </div>
      </div>

      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="text-center text-sm text-muted">
                © <script>document.write(new Date().getFullYear())</script>, 
                made with <i class="fa fa-heart"></i> by 
                <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item"><a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a></li>
                <li class="nav-item"><a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a></li>
                <li class="nav-item"><a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a></li>
                <li class="nav-item"><a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <!-- QR Code Reader Script -->
  <script>
    document.getElementById('open-qr-reader').addEventListener('click', () => {
      const qrReader = document.getElementById('qr-reader');
      const qrResult = document.getElementById('qr-result');
      const button = document.getElementById('open-qr-reader');

      if (qrReader.style.display === 'none') {
        qrReader.style.display = 'block';
        button.innerHTML = '<i class="fa fa-stop"></i> Stop QR Code Scanner';

        const html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
          { facingMode: "environment" },
          { fps: 10, qrbox: { width: 250, height: 250 } },
          (decodedText) => {
            html5QrCode.stop();
            qrReader.style.display = 'none';
            qrResult.style.display = 'block';
            qrResult.textContent = `QR Code Result: ${decodedText}`;
            button.innerHTML = '<i class="fa fa-qrcode"></i> Open QR Code Scanner';
          },
          (errorMessage) => console.warn("QR scanning error:", errorMessage)
        ).catch(err => console.error("Error initializing QR scanner:", err));
      } else {
        qrReader.style.display = 'none';
        qrResult.style.display = 'none';
        button.innerHTML = '<i class="fa fa-qrcode"></i> Open QR Code Scanner';
      }
    });
  </script>

  <!-- Core JS Files -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>
