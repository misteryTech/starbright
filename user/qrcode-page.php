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
</div>

<div class="col-md-12 text-center mt-4">
  <label for="barcodeInput" class="form-label">Enter or Scan QR Code</label>
  <input type="text" class="form-control" id="barcodeInput" placeholder="Enter QR Code">
  <button type="button" id="searchButton" class="btn btn-primary w-50 mt-2">Search</button>
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


<!-- Product Info Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Product Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="productDetails">
        <!-- Product details will be injected here -->
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
  const qrReaderContainer = document.getElementById("qr-reader");
  const openQrBtn = document.getElementById("open-qr-reader");
  const input = document.getElementById("barcodeInput");
  const productModal = document.getElementById("productModal");
  let qrScanner;

  function fetchProduct(code) {
    fetch('get_product.php?code=' + encodeURIComponent(code))
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const product = data.product;
          document.getElementById("productDetails").innerHTML = `
            <img src="../admin/process/${product.image}" alt="${product.name}" class="img-fluid rounded mb-3" style="max-width: 300px;">
            <p><strong>Name:</strong> ${product.name}</p>
            <p><strong>Slug:</strong> ${product.slug}</p>
          `;
          const modal = new bootstrap.Modal(productModal);
          modal.show();
        } else {
          alert(data.message || "Product not found");
        }
      })
      .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while fetching the product.");
      });
  }

  function startScanner() {
    if (!qrScanner) {
      qrScanner = new Html5Qrcode("qr-reader");
    }

    qrReaderContainer.style.display = "block";
    qrScanner.start(
      { facingMode: "environment" },
      { fps: 10, qrbox: 250 },
      (decodedText) => {
        qrScanner.stop().then(() => {
          qrReaderContainer.style.display = "none";
          input.value = decodedText;
          fetchProduct(decodedText);
        });
      },
      (errorMessage) => {
        // optional: console.warn(errorMessage);
      }
    ).catch(err => {
      console.error("QR Scanner failed to start", err);
    });
  }

  openQrBtn.addEventListener("click", startScanner);

  document.getElementById("searchButton").addEventListener("click", function () {
    const code = input.value.trim();
    if (!code) {
      alert("Please enter a QR Code");
      return;
    }
    fetchProduct(code);
  });

  // Restart scanner when product modal is closed
  productModal.addEventListener("hidden.bs.modal", () => {
    startScanner();
  });
</script>

</body>
</html>
