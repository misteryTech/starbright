<?php include("../layout/header.php"); ?>
<style>

</style>

<body class="g-sidenav-show bg-gray-100">

  <?php include("aside.php"); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

  
    <?php include("topnav.php"); ?>
    <div class="container-fluid py-4">
      <div class="row my-4">
  

      <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
  <div class="card">
    <div class="card-header pb-0">
      <h6>Product Registration</h6>
      <p class="text-sm mb-0">Input the product details.</p>
    </div>
    <div class="card-body px-4 pb-4">
    <?php
    if (isset($_SESSION['success'])) {
        echo '<div id="success-message" class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); // Remove message after displaying
    }
    ?>



    <form action="process/register-product.php" method="POST" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-6 mb-3">
        <label for="productview" class="form-label">Product View</label>
                    <div class="image-show">

                    </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="qrview" class="form-label">QRCODE Image</label>
        <div class="qrcode-show"></div> <!-- Ensure this class exists --> 
             
        </div>

    </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="productImage" class="form-label">Product Image</label>
      <input type="file" class="form-control" id="productImage" name="product_image" required>
    </div>
    <div class="col-md-6 mb-3">

      <label for="productImage" class="form-label">Product QRCODE</label>
      <input type="text" class="form-control" id="productQRcode" name="product_qr" required>
    </div>
 

 
  </div>
  
  <div class="row">
  <div class="col-md-6 mb-3">
    <label for="productName" class="form-label">Product Name</label>
    <input type="text" id="productName"   class="form-control" name="product_name" required>

</div>

<div class="col-md-6 mb-3">
    <label for="productSlug" class="form-label">Slug</label>
    <input type="text" class="form-control" id="productSlug" name="product_slug" required readonly>
    <small id="slugError" class="text-danger" style="display:none;">This slug is already taken.</small>
</div>


<?php

// Fetch brands from attributes where attribute_name = 'Brand'
$sql = "SELECT id, attribute_name FROM attributes ";
$result = $conn->query($sql);
?>

<div class="col-md-6 mb-3">
    <label for="productBrand" class="form-label">Brand</label>
    <select class="form-select" id="productBrand" name="product_brand" onchange="fetchCategories()">
        <option selected>Select Brand</option>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['attribute_name']) . '</option>';
            }
        } else {
            echo '<option disabled>No brands available</option>';
        }
        ?>
    </select>
</div>

<div class="col-md-6 mb-3">
    <label for="productCategory" class="form-label">Category</label>
    <select class="form-select" id="productCategory" name="product_category">
        <option selected>Select Category</option>
    </select>
</div>

  </div>

  
  <button type="submit" class="btn btn-primary w-100">Register Product</button>
</form>


    </div>
  </div>
</div>




        <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
             
            </div>
            <div class="card-body d-flex flex-column">
           
              <div class="add-to-cart-container">
                <button id="addToCart" class="btn btn-secondary w-100 mt-5" style="display: none;">Add to Cart</button>
              </div>
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
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>


  <!-- Include QRCode.js --><!-- Include QRCode.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>


document.addEventListener("DOMContentLoaded", function () {
    const productNameInput = document.getElementById("productName"); // FIXED: Defined the variable
    const productImageInput = document.getElementById("productImage");
    const imageShowDiv = document.querySelector(".image-show");
    const productQRcodeInput = document.getElementById("productQRcode");
    const slugInput = document.getElementById("productSlug");
    const slugError = document.getElementById("slugError");
    const qrcodeShowDiv = document.querySelector(".qrcode-show");



    // Function to fetch a new QR code from the database
    function fetchQRCode() {
      fetch("validate/check_qrcode.php")
        .then(response => response.json())
        .then(data => {
          if (data.new_qr) {
            productQRcodeInput.value = data.new_qr; // Set new QR code
            generateQRCode(data.new_qr); // Generate QR code
          }
        })
        .catch(error => console.error("Error fetching QR code:", error));
    }

    // Function to generate QR code
    function generateQRCode(value) {
      if (!qrcodeShowDiv) return;
      qrcodeShowDiv.innerHTML = ""; // Clear previous QR code
      new QRCode(qrcodeShowDiv, {
        text: value,
        width: 180,
        height: 180
      });
    }

    // Fetch and display QR code on page load
    fetchQRCode();

    // Function to preview uploaded image
    if (productImageInput) {
      productImageInput.addEventListener("change", function (event) {
        const file = event.target.files[0];

        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            imageShowDiv.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded shadow-sm" style="max-width: 100%; height: auto;">`;
          };
          reader.readAsDataURL(file);
        }
      });
    }

    // Ensure all required elements exist before proceeding
    if (!productNameInput || !slugInput || !slugError) {
        console.error("One or more elements are missing from the DOM.");
        return;
    }

    async function checkSlugAvailability(slug) {
    console.log(`Checking availability for slug: ${slug}`);
    
    try {
        const response = await fetch("validate/check_slug.php?slug=" + encodeURIComponent(slug));
        
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();
        console.log(`Slug exists: ${data.exists}`); // Debugging output

        return data.exists; // True if slug exists, false if available
    } catch (error) {
        console.error("Error checking slug availability:", error);
        return false; // Assume slug is available if there's an error
    }
}




    async function generateSlug() {
    let productName = document.getElementById("productName").value.trim();
    let slugInput = document.getElementById("productSlug");
    let slugError = document.getElementById("slugError");



    if (!productName) {
        slugInput.value = "";
        slugError.style.display = "none";
        return;
    }

    let baseSlug = productName
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '') 
        .replace(/\s+/g, '-') 
        .replace(/-+/g, '-'); 

    let finalSlug = baseSlug;
    let count = 1;

    // Check if slug exists in the database
    while (await checkSlugAvailability(finalSlug)) {
        finalSlug = `${baseSlug}-${count}`;
        count++;
    }

    slugInput.value = finalSlug;

    // Show or hide error message
    if (finalSlug !== baseSlug) {
        slugError.style.display = "block";
    } else {
        slugError.style.display = "none";
    }
}


async function checkSlugAvailability(slug) {
    console.log(`Attempting to check availability for: ${slug}`);

    try {
        const response = await fetch("validate/check_slug.php?slug=" + encodeURIComponent(slug));
        
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        const data = await response.json();
        console.log(`Slug exists: ${data.exists}`); // Log the response
        return data.exists; // True if slug exists, false if available
    } catch (error) {
        console.error("Error checking slug availability:", error);
        return false;
    }
}




    // Attach event listener after confirming elements exist
    productNameInput.addEventListener("input", generateSlug);
});

// Fetch categories function
function fetchCategories() {
    let brandId = document.getElementById("productBrand").value;
    let categoryDropdown = document.getElementById("productCategory");

    categoryDropdown.innerHTML = '<option selected>Loading...</option>'; // Show loading state

    fetch("validate/fetch_categories.php?brand_id=" + brandId)
    .then(response => response.json())
    .then(data => {
        categoryDropdown.innerHTML = '<option selected>Select Category</option>';
        if (data.length > 0) {
            data.forEach(category => {
                categoryDropdown.innerHTML += `<option value="${category.id}">${category.value}</option>`;
            });
        } else {
            categoryDropdown.innerHTML = '<option disabled>No categories available</option>';
        }
    })
    .catch(error => console.error("Error fetching categories:", error));
}

</script>




</body>
</html>
