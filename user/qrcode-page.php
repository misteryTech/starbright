<?php include("../layout/header.php"); ?>


<body class="g-sidenav-show bg-gray-100">

  <?php include("aside.php"); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">


    <?php include("topnav.php"); ?>
    <div class="container-fluid py-4">
      <div class="row my-4">
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Search Product</h6>
              <p class="text-sm mb-0">Search for a product using QR Code or barcode input.</p>
            </div>
            <div class="card-body px-4 pb-4">
              <form id="searchForm">
                <div class="row">
                <div class="col-md-12 text-center">
                   <button id="open-qr-reader" type="button" class="btn btn-primary w-50">
                     <i class="fa fa-qrcode"></i> Open QR Code Scanner
                   </button>
                  <div id="qr-reader" style="width: 300px; margin: auto; display: none;"></div>
                  <p id="qr-result" class="mt-3 text-success" style="display: none;"></p>
                </div>



                  <div class="col-md-12 text-center">
                    <div class="mb-3">
                      <label for="barcodeInput" class="form-label">Search via Barcode</label>
                      <input type="text" class="form-control" id="barcodeInput" name="barcode" placeholder="Enter barcode">
                    </div>
                    <button type="button" id="searchButton" class="btn btn-primary w-50">Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Product Overview  
              <button id="cartButton" class="btn-primary cart-button"><span>Cart</span><div id="cartBadge" class="cart-badge" style="display: none;">0</div></button>
              </h6>
              <p class="text-sm text-success"><i class="fa fa-info-circle"></i> Details of the searched product.</p>
            </div>

          </div>
        </div>
      </div>

      <div id="cartModal" class="modal fade" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="cartModalLabel">Cart</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <ul id="cartItemsList"></ul>
              <button id="requestButton" class="btn btn-success w-100" style="display: none;">Request</button>
            </div>
          </div>
        </div>
      </div>

      <?php include("footer.php"); ?>
    </div>
  </main>
  <?php include("fixed-plugin.php"); ?>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

  <script>
     const qrResult = document.getElementById("qr-result");
  const qrReaderContainer = document.getElementById("qr-reader");
  const openQrBtn = document.getElementById("open-qr-reader");

  let qrScanner;

  openQrBtn.addEventListener("click", () => {
    qrReaderContainer.style.display = "block";

    if (!qrScanner) {
      qrScanner = new Html5Qrcode("qr-reader");

      qrScanner.start(
        { facingMode: "environment" }, // Rear camera
        {
          fps: 10,    // Scans per second
          qrbox: 250  // Size of the scanning box
        },
        (decodedText, decodedResult) => {
          qrResult.innerText = `Scanned: ${decodedText}`;
          qrResult.style.display = "block";

          // Stop scanner after successful scan
          qrScanner.stop().then(() => {
            qrReaderContainer.style.display = "none";
          });
        },
        (errorMessage) => {
          // Optional: handle scan failure or log errors
        }
      ).catch(err => {
        console.error("QR Scanner failed to start", err);
      });
    }
  });
  </script>
</body>
</html>
