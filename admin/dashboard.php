<?php include("../layout/header.php"); ?>
<style>
 #qr-reader {
  width: 250px;
  margin: auto;
  display: none;
}

#productImage {
  width: 200px;
  height: 200px;
  object-fit: cover;
  margin-right: 20px;
}

.product-details-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.product-details {
  flex: 1;
}

.cart-container {
  display: flex;
  align-items: center;
  margin-left: 20px;
}

.cart-button {
  width: 120px;
  height: 40px;
  background-color: #28a745;
  color: white;
  font-size: 16px;
  border-radius: 3px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  position: relative;

  font-weight: bold;
}

.cart-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  width: 20px;
  height: 20px;
  background-color: red;
  color: white;
  border-radius: 50%;
  font-size: 12px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2px 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.cart-button-container {
  position: relative;
}

.cart-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  align-items: center;
}

.cart-item input {
  width: 50px;
}

.add-to-cart-container {
  margin-top: auto;
}

</style>

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
                  <div class="col-md-6 text-center">
                    <button id="open-qr-reader" type="button" class="btn btn-primary w-100">
                      <i class="fa fa-qrcode"></i> Open QR Code Scanner
                    </button>
                    <div id="qr-reader"></div>
                    <p id="qr-result" class="mt-3 text-success" style="display: none;"></p>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="barcodeInput" class="form-label">Search via Barcode</label>
                      <input type="text" class="form-control" id="barcodeInput" name="barcode" placeholder="Enter barcode">
                    </div>
                    <button type="button" id="searchButton" class="btn btn-primary w-100">Search</button>
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
              <button id="cartButton" class="btn-primary cart-button"><span>Cart</span><div id="cartBadge" class="cart-badge" style="display: none;">0</div>
</button>

              </h6>
              <p class="text-sm text-success"><i class="fa fa-info-circle"></i> Details of the searched product.</p>
            </div>
            <div class="card-body d-flex flex-column">
              <div id="productDetails" class="product-details-container">
                <img id="productImage" src="" alt="Product Image">
                <div class="product-details">
                  <h6 id="productTitle">No product selected.</h6>
                  <p id="productDescription">Please scan or enter a barcode.</p>
                </div>
              </div>
              <div class="add-to-cart-container">
                <button id="addToCart" class="btn btn-secondary w-100 mt-5" style="display: none;">Add to Cart</button>
              </div>
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

  <script>
    const qrReader = document.getElementById('qr-reader');
    const qrResult = document.getElementById('qr-result');
    const searchButton = document.getElementById('searchButton');
    const productDetails = document.getElementById('productDetails');
    const addToCartButton = document.getElementById('addToCart');
    const cartButton = document.getElementById('cartButton');
    const cartBadge = document.getElementById('cartBadge');
    const cartItemsList = document.getElementById('cartItemsList');
    const requestButton = document.getElementById('requestButton');
    let cart = [];
    let html5QrCode;
    let scannerOpen = false;

    document.getElementById('open-qr-reader').addEventListener('click', () => {
      if (!scannerOpen) {
        scannerOpen = true;
        document.getElementById('open-qr-reader').disabled = true;
        qrReader.style.display = 'block';
        html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
          { facingMode: "environment" },
          { fps: 10, qrbox: { width: 250, height: 250 } },
          (decodedText) => {
            fetchProductDetails(decodedText);
            html5QrCode.stop();
            qrReader.style.display = 'none';
            document.getElementById('open-qr-reader').disabled = false;
            scannerOpen = false;
          },
          (errorMessage) => {
            console.warn("QR scanning error:", errorMessage);
          }
        ).catch(err => {
          console.error("QR Code initialization failed:", err);
          document.getElementById('open-qr-reader').disabled = false;
        });
      }
    });

    searchButton.addEventListener('click', () => {
      const barcode = document.getElementById('barcodeInput').value.trim();
      if (barcode) {
        fetchProductDetails(barcode);
      } else {
        alert("Please enter a barcode to search.");
      }
    });

    function fetchProductDetails(identifier) {
      fetch(`fetch/get-product.php?identifier=${encodeURIComponent(identifier)}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const product = data.product;
            const productHtml = `
              <div class="product-details-container">
                <img id="productImage" src="process/${product.image_path}" alt="Product Image">
                <div class="product-details">
                  <h6 id="productTitle">${product.name}</h6>
                  <p>Type: ${product.type}</p>
                  <p>Barcode: ${product.barcode}</p>
                  <p>Quantity: ${product.quantity}</p>
                  <p>Unit: ${product.unit}</p>
                </div>
              </div>
            `;
            productDetails.innerHTML = productHtml;
            addToCartButton.style.display = 'block';
          } else {
            productDetails.innerHTML = `<p class="text-danger">No product found with this identifier.</p>`;
            addToCartButton.style.display = 'none';
          }
        })
        .catch(error => {
          console.error("Error fetching product details:", error);
          productDetails.innerHTML = `<p class="text-danger">Failed to fetch product details. Please try again later.</p>`;
          addToCartButton.style.display = 'none';
        });
    }

    addToCartButton.addEventListener('click', () => {
      const product = document.querySelector('#productDetails h6').innerText;
      const barcode = document.getElementById('barcodeInput').value.trim();
      const existingItemIndex = cart.findIndex(item => item.barcode === barcode);
      if (existingItemIndex !== -1) {
        cart[existingItemIndex].quantity += 1;
      } else {
        cart.push({ name: product, barcode: barcode, quantity: 1 });
      }
      updateCartBadge();
      updateCartList();
    });

  // Update Cart Badge and List inside Cart Button
  function updateCartBadge() {
  const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
  if (cartCount > 0) {
    cartBadge.style.display = 'inline-block'; // Ensure it's visible
    cartBadge.innerText = cartCount; // Show only the number for readability
  } else {
    cartBadge.style.display = 'none'; // Hide the badge if no items
  }
}

    function updateCartList() {
      cartItemsList.innerHTML = '';
      cart.forEach((item, index) => {
        const li = document.createElement('li');
        li.classList.add('cart-item');
        li.innerHTML = `
          ${item.name} - ${item.barcode} 
          <input type="number" value="${item.quantity}" min="1" data-index="${index}" class="quantity-input">
        `;
        cartItemsList.appendChild(li);
      });

      document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', (e) => {
          const index = e.target.getAttribute('data-index');
          const quantity = parseInt(e.target.value, 10);
          if (quantity > 0) {
            cart[index].quantity = quantity;
            updateCartBadge();
          } else {
            alert('Quantity must be greater than 0.');
            e.target.value = cart[index].quantity;
          }
        });
      });
    }

    cartButton.addEventListener('click', () => {
      $('#cartModal').modal('show');
    });

    requestButton.addEventListener('click', () => {
      console.log('Requesting items:', cart);
    });
  </script>

  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>
</html>
