<?php include("../layout/header.php"); ?>
<style>

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


<?php


// Check if an ID is passed via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
} else {
    die("Invalid Product ID");
}

// Fetch brands for dropdown
$sql = "SELECT id, attribute_name FROM attributes";
$brands = $conn->query($sql);


?>


<?php

if (isset($_SESSION['alert'])) {
    echo '<div class="alert alert-' . $_SESSION['alert']['type'] . ' alert-dismissible fade show" role="alert">'
        . $_SESSION['alert']['message'] .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    unset($_SESSION['alert']); // Remove alert after displaying
}

?>
<form action="process/register-product.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="productview" class="form-label">Product View</label>
            <div class="image-show">
                <?php if (!empty($product['image'])): ?>
                    <img src="process/<?= htmlspecialchars($product['image']) ?>" width="100">
                <?php endif; ?>
            </div>
        </div>

        
        <div class="col-md-6 mb-3">
            <label for="qrview" class="form-label">QR Code Image</label>
            <div class="qrcode-show">
                <?php if (!empty($product['qr_code_image'])): ?>
                    <img src="process/<?= htmlspecialchars($product['qr_code_image']) ?>" width="100">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="productImage" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="productImage" name="product_image">
        </div>
        <div class="col-md-6 mb-3">
            <label for="productQRcode" class="form-label">Product QR Code</label>
            <input type="text" class="form-control" id="productQRcode" name="product_qr" value="<?= htmlspecialchars($product['product_qr']) ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" id="productName" class="form-control" name="product_name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="productSlug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="productSlug" name="product_slug" value="<?= htmlspecialchars($product['slug']) ?>" required readonly>
            <small id="slugError" class="text-danger" style="display:none;">This slug is already taken.</small>
        </div>

        <div class="col-md-6 mb-3">
            <label for="productBrand" class="form-label">Brand</label>
            <select class="form-select" id="productBrand" name="product_brand" onchange="fetchCategories()">
                <option selected>Select Brand</option>
                <?php while ($row = $brands->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>" <?= ($row['id'] == $product['brand_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['attribute_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="productCategory" class="form-label">Category</label>
            <select class="form-select" id="productCategory" name="product_category">
                <option selected>Select Category</option>
                <option value="<?= htmlspecialchars($product['category_id']) ?>" selected>
                    <?= htmlspecialchars($product['category_id']) ?>
                </option>
            </select>
        </div>
        
                </form>
<!-- Stocks Modal -->
<div class="modal fade" id="stocksModal" tabindex="-1" aria-labelledby="stocksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stocksModalLabel">Manage Product Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="stockForm" action="stocking/process_stock.php" method="POST" enctype="multipart/form-data">
            <div class="row">
    <!-- Hidden Product ID -->
    <input type="hidden" class="form-control" value="<?= htmlspecialchars($product['product_qr']) ?>" name="productId">

    <!-- Left Column: Image and Name -->
    <div class="col-md-6 d-flex align-items-center">
        <div>
            <img src="process/<?= htmlspecialchars($product['image']) ?>" width="150" class="img-fluid mb-3">
       
        </div>
    </div>

    <!-- Right Column: QR Code -->
    <div class="col-md-6 d-flex align-items-center">
        <div>
          
     
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        </div>

      
    </div>
   
</div> 

<div id="formsContainer" class="mt-3 col-12"></div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="addValuesBtn">Add Values</button>
                <button type="submit" class="btn btn-primary" id="updateStockBtn">Update Stock</button>
            </div>
        </div>
    </div>
</div>



    </div>

    
</form>

    </div>
  </div>
</div>

        <div class="col-lg-6 col-md-6">
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

      <script>

// document.addEventListener('DOMContentLoaded', function () {
//     // Array to track selected values globally
//     let selectedValues = [];

//     // Function to fetch values based on productBrand
//     function fetchValues(attributeId, selectElement) {
//     console.log("Fetching values for attribute ID:", attributeId); // Debugging

//     $.ajax({
//         url: "fetch/fetch_values.php",
//         method: "POST",
//         data: { attribute_id: attributeId },
//         success: function (response) {
//             console.log("Received response:", response); // Debugging
//             if (response.trim() === "") {
//                 console.error("Error: No data received from fetch_values.php");
//             } else {
//                 selectElement.innerHTML = '<option value="">--SELECT VALUES--</option>' + response;
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error("AJAX Error:", error);
//         }
//     });
// }


//     // Function to disable already selected values in the dropdown
//     function disableSelectedValues(selectElement) {
//         const options = selectElement.querySelectorAll('option');
//         options.forEach(option => {
//             option.disabled = selectedValues.includes(option.value);
//         });
//     }

//     // Fetch values for the initial select if a product brand is selected
//     document.getElementById("productBrand").addEventListener("change", function () {
//     let attributeId = this.value;
//     let selectElement = document.querySelector("select[name='values[]']");
//     fetchValues(attributeId, selectElement);
// });


//     // Add a new form when "Add Values" button is clicked
//     document.getElementById('addValuesBtn').addEventListener('click', function () {
//         const formsContainer = document.getElementById('formsContainer');
//         const attributeId = $("#productBrand").val();

//         if (attributeId) {
//             // Create a new form div
//             const newFormDiv = document.createElement('div');
//             newFormDiv.classList.add('border', 'p-3', 'mt-2', 'rounded');
//             newFormDiv.style.border = '1px solid #ccc';

//             newFormDiv.innerHTML = `
//                 <div class="row">
//                     <div class="col-md-8">
//                         <label for="values">Values</label>
//                         <select class="form-select" name="values[]">
//                             <option value="">--SELECT VALUES--</option>
//                         </select>
//                     </div>
//                 </div>
//                 <div class="row mt-2">
//                     <div class="col-md-5">
//                         <div id="product_img_preview"></div>
//                         <label for="product_img">Product Image</label>
//                         <input type="file" class="form-control" name="product_img[]" multiple>
//                     </div>
//                     <div class="col-md-5">
//                         <div id="additional_img_preview"></div>
//                         <label for="additional_img">Add Image</label>
//                         <input type="file" class="form-control" name="additional_img[]" multiple>
//                     </div>
//                     <div class="col-md-4">
//                         <label for="itemcode">Item Code (SKU)</label>
//                         <input type="text" class="form-control" name="itemcode[]">
//                     </div>
//                     <div class="col-md-4">
//                         <label for="barcode">BarCode</label>
//                         <input type="text" class="form-control" name="barcode[]">
//                     </div>
//                     <div class="col-md-4">
//                         <label for="status">Status</label>
//                         <select class="form-control" name="status[]">
//                             <option value="">--SELECT STATUS--</option>
//                             <option value="In Stock">In Stock</option>
//                             <option value="Out of Stock">Out of Stock</option>
//                             <option value="Back Order">Back Order</option>
//                         </select>
//                     </div>
//                 </div>
//                 <div class="row">
//                     <div class="col-md-3">
//                         <label for="weight" class="form-label">Weight (kg)</label>
//                         <input type="number" class="form-control" name="weight">
//                     </div>
//                     <div class="col-md-3">
//                         <label for="length" class="form-label">Length</label>
//                         <input type="number" class="form-control" name="length">
//                     </div>
//                     <div class="col-md-3">
//                         <label for="width" class="form-label">Width</label>
//                         <input type="number" class="form-control" name="width">
//                     </div>
//                     <div class="col-md-3">
//                         <label for="height" class="form-label">Height</label>
//                         <input type="number" class="form-control" name="height">
//                     </div>
//                     <div class="col-md-12">
//                         <label for="productDescription" class="form-label">Description</label>
//                         <textarea class="form-control" name="description" rows="4" placeholder="Enter product description"></textarea>
//                     </div>
//                 </div>
//                 <div class="text-end mt-2">
//                     <button type="button" class="btn btn-danger removeFormBtn">Remove</button>
//                 </div>
//             `;

//             // Append the new form div to the container
//             formsContainer.appendChild(newFormDiv);

//             // Add event listeners for image preview after adding the new elements
//             const productImgInput = newFormDiv.querySelector('input[name="product_img[]"]');
//             const additionalImgInput = newFormDiv.querySelector('input[name="additional_img[]"]');

//             if (productImgInput) {
//                 productImgInput.addEventListener('change', function (event) {
//                     previewMultipleImages(event, newFormDiv.querySelector('#product_img_preview'));
//                 });
//             }

//             if (additionalImgInput) {
//                 additionalImgInput.addEventListener('change', function (event) {
//                     previewMultipleImages(event, newFormDiv.querySelector('#additional_img_preview'));
//                 });
//             }

//             // Fetch values for the newly added select dropdown
//             const newSelect = newFormDiv.querySelector('select[name="values[]"]');
//             fetchValues(attributeId, newSelect);

//             // Add event listener to track selected value in the new dropdown
//             newSelect.addEventListener('change', function () {
//                 const selectedValue = this.value;
//                 if (selectedValue && !selectedValues.includes(selectedValue)) {
//                     selectedValues.push(selectedValue);
//                     disableAllDropdowns();
//                 }
//             });

//             // Add event listener for remove button
//             newFormDiv.querySelector('.removeFormBtn').addEventListener('click', function () {
//                 const removedSelect = newFormDiv.querySelector('select[name="values[]"]');
//                 const removedValue = removedSelect.value;
//                 if (removedValue && selectedValues.includes(removedValue)) {
//                     selectedValues = selectedValues.filter(value => value !== removedValue);
//                     disableAllDropdowns();
//                 }
//                 formsContainer.removeChild(newFormDiv);
//             });
//         } else {
//             alert("Please select a product brand first.");
//         }
//     });

//     // Function to disable all dropdowns based on selected values
//     function disableAllDropdowns() {
//         const selects = document.querySelectorAll('select[name="values[]"]');
//         selects.forEach(select => {
//             disableSelectedValues(select);
//         });
//     }

//     // Function to preview multiple selected images
//     function previewMultipleImages(event, previewContainer) {
//         const files = event.target.files;
//         previewContainer.innerHTML = ''; // Clear any previous previews

//         Array.from(files).forEach(file => {
//             const reader = new FileReader();
//             reader.onload = function (e) {
//                 const imgFrame = document.createElement('div');
//                 imgFrame.style.display = 'inline-block';
//                 imgFrame.style.margin = '5px';
//                 imgFrame.style.border = '1px solid #ccc';
//                 imgFrame.style.padding = '5px';

//                 const img = document.createElement('img');
//                 img.src = e.target.result;
//                 img.classList.add('img-thumbnail');
//                 img.style.maxWidth = '100px';
//                 img.style.height = 'auto';

//                 imgFrame.appendChild(img);
//                 previewContainer.appendChild(imgFrame);
//             };

//             if (file) {
//                 reader.readAsDataURL(file);
//             }
//         });
//     }

//     // Ensure the modal form also respects the selected values on page load
//     const modalSelect = document.querySelector('select[name="modalValues[]"]');  // Update this with the correct modal selector
//     if (modalSelect) {
//         modalSelect.addEventListener('change', function () {
//             const selectedValue = this.value;
//             if (selectedValue && !selectedValues.includes(selectedValue)) {
//                 selectedValues.push(selectedValue);
//                 disableAllDropdowns();
//             }
//         });

//         // Immediately apply validation to the modal when it is opened
//         const openModalButton = document.getElementById('openModalBtn');  // Update with actual modal open button ID
//         openModalButton.addEventListener('click', function () {
//             disableAllDropdowns();  // Disable values in the modal when it opens
//         });
//     }
// });



// document.getElementById("stockForm").addEventListener("submit", function (event) {
//     let form = this;

//     document.querySelectorAll("select[name='values[]']").forEach((select) => {
//         if (!select.value) return; // Skip empty selections

//         let hiddenInput = document.createElement("input");
//         hiddenInput.type = "hidden";
//         hiddenInput.name = "values[]";
//         hiddenInput.value = select.value;
//         form.appendChild(hiddenInput);
//     });

//     console.log("Submitting form with values:", new FormData(form));
// });



</script>



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






</body>
</html>
