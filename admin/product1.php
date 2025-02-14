<?php include("../layout/header.php"); ?>

<body class="g-sidenav-show  bg-gray-100">

<?php include("aside.php"); ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Attributes</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Attributes</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-soft-ui-dashboard">Online Builder</a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0 ">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
         <div class="card">
            <div class="card-header pb-0">
               <h6>Attributes</h6>
               <p class="text-sm mb-0">Fill in the details below to register your attributes.</p>
             </div>
             <div class="card-body px-4 pb-4">
             <form id="productRegistration" method="POST" enctype="multipart/form-data">
                <!-- Tab Navigation -->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-single-tab" data-bs-toggle="pill" href="#pills-single" role="tab" aria-controls="pills-single" aria-selected="true">Single Product</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-variation-tab" data-bs-toggle="pill" href="#pills-variation" role="tab" aria-controls="pills-variation" aria-selected="false">Product Variation</a>
                  </li>
                </ul>
                <div class="row">

                <div class="col-md-6">
          
                <div class="mb-3">
                          <label for="productName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="productName" name="productname" placeholder="Enter product name"  oninput="generateSlug()" required>
                  </div>

                  
                <div class="mb-3">
                          <label for="productName" class="form-label">Slug</label>
                          <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" required>
                  </div>



                </div>

                <div class="col-md-6">
          
          <div class="mb-3">
                   
                    <label for="productImage" class="form-label">Product Image</label>
                    <span id="showImage" class="d-block mb-2"></span> <!-- Image will be shown here -->
                    <input type="file" class="form-control" id="productImage" name="image" required accept="image/*">
            </div>

          </div>



                  <div class="col-md-6">
            
                  <div class="mb-3">
    <label for="qrcode" class="form-label">Product QRCODE</label>
    <input type="text" class="form-control" id="qrcode" name="qrcode" required readonly>
</div>

<div class="mb-3">
                          <label for="productCategory" class="form-label">Category</label>
                          <select class="form-control" id="category" name="category">
                                         <option value="N/A">--SELECT CATEGORY--</option>
                                         <option value="arts-&-crafts">Arts & Crafts</option>
                                         <option value="bags-&-pouches">Bags & Pouches</option>
                                         <option value="binders-envelopes-&-folders">Binders, Envelopes & Folders</option>
                                         <option value="books-&-visual-aids">Books & Visual Aids</option>
                                         <option value="cutting-&-binding-tools">Cutting & Binding Tools</option>
                                         <option value="desk-accessories">Desk Accessories</option>
                                     
                                   </select>
                        </div>

                </div>
                <div class="col-md-6">
    <div class="mb-3">
        <label for="qrcodeImage" class="form-label">QR CODE Image</label>
        <div>
            <img id="qrcodeImage" src="" alt="QR Code" style="width: 150px; height: 150px;">
        </div>


</div>
                   
                      </div>

                </div>


                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                  <!-- Single Product Tab -->
                  <div class="tab-pane fade show active" id="pills-single" role="tabpanel" aria-labelledby="pills-single-tab">
                    <div class="row">

                             
                             
                    <div class="col-md-6">

                        <div class="mb-3">
                        <label for="productVariationName" class="form-label">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode"  >
                        </div>

                        <div class="mb-3">

                        <label for="productVariationName" class="form-label">Item Code</label>
                        <input type="text" class="form-control" id="itemcode" name="itemcode"  >
                        </div>


                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">

                        <label for="productVariationName" class="form-label">Stock Status</label>
                                    <select class="form-control" id="stock_status" name="stock_status">  
                                        <option value="N/A">--SELECT STATUS--</option>
                                       <option value="Instock">Instock</option>
                                       <option value="out-of-stock">Out of Stock</option>
                                       <option value="backorder">Backorder</option>
                                     
                                   </select>
                        </div>

                        <div class="mb-3">
                          <label for="productUnit" class="form-label">Unit</label>
                          <select class="form-control" id="unit" name="unit" >
                            <option value="N/A">--SELECT UNIT--</option>
                            <option value="piece">Piece</option>
                            <option value="box">Box</option>
     
                        </select>

                        </div>


                      </div>




                        
                      <h6>Dimensions (L×W×H) (cm)</h6>
                      <!-- Single Product Fields -->
                       <div class="col-md-3">
                       <div class="mb-3">
                                        <label for="productVariationName" class="form-label">Weight (kg)</label>
                                        <input type="number" class="form-control" id="weight" name="weight"  >
                       </div>
                      </div>


                      <div class="col-md-3">
                       <div class="mb-3">

                                        <label for="productVariationName" class="form-label">Lenght</label>
                                        <input type="number" class="form-control" id="length" name="length"  >
                       </div>
                      </div>


                      <div class="col-md-3">
                       <div class="mb-3">

                                        <label for="productVariationName" class="form-label">Width</label>
                                        <input type="number" class="form-control" id="width" name="width"  >
                       </div>
                      </div>




                      <div class="col-md-3">
                       <div class="mb-3">

                                        <label for="productVariationName" class="form-label">Height</label>
                                        <input type="number" class="form-control" id="height" name="height"  >
                       </div>
                      </div>
                      
             


                        <div class="col-md-12">
                        <div class="mb-3">
                          <label for="productDescription" class="form-label">Description</label>
                          <textarea class="form-control" id="productDescription" name="description" rows="4" placeholder="Enter product description" ></textarea>
                        </div>
          
                      </div>
                    </div>
                    </div>
             

                  <!-- Product Variation Tab -->
                  <div class="tab-pane fade" id="pills-variation" role="tabpanel" aria-labelledby="pills-variation-tab">

                  <div class="row">
                  <div class="col-md-6">
                        <div class="mb-3">

                        <?php

                            include("connection.php");
                          // Fetch variations
                          $sql = "SELECT id, attribute_name FROM attributes";
                          $result = $conn->query($sql);

                          $options = "";
                          while ($row = $result->fetch_assoc()) {
                           $options .= "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['attribute_name']) . "</option>";
                            }

                        ?>
                          <label for="productVariationName" class="form-label">Variation Name</label>
                                    <select class="form-control" id="productVariationDropdown" name="productionVariations" onchange="productAttrib()">
                                       <option value="">Select a variation</option>
                                       <?php echo $options; ?>
                                   </select>
                         </div>

                        </div>

                        <div class="col-md-6">
                               <div class="mb-3">

                   
                                    <label for="productVariationName" class="form-label">

                                    </label>
                                    <button type="button" class="btn btn-success w-100"  id="addValueBtn" >Add Values</button>
                                    </div>


                         </div>


                       
                  </div>
                            <div id="productVariations">
                                    <div class="row variation-form border p-3 mb-3 border-primary">
                      <!-- Variation Fields -->
                    
                    
                        <div class="col-md-6">


                        <div class="mb-3">

                   
                            <label for="productVariationName" class="form-label">Values</label>
                            <select  class="form-control"  id="attributeValuesDropdown" name="variation_values">
                                <option value="">Select an option</option>
                            </select>
                            </div>




                        <div class="mb-3">
                        <label for="variation_itemcode" class="form-label">Barcode</label>
                        <input type="text" class="form-control" id="variation_barcode" name="variation_barcode"  >
                        </div>

                        <div class="mb-3">

                        <label for="variation_itemcode" class="form-label">Item Code</label>
                        <input type="text" class="form-control" id="variation_itemcode" name="variation_itemcode"  >
                        </div>
                   
                      </div>


                      <div class="col-md-6">
                 


                        <div class="mb-3">

                        <label for="productVariationName" class="form-label">Stock Status</label>
                                    <select class="form-control" id="stock_status" name="variation_stock_status">  
                                        <option value="N/A">--SELECT STATUS--</option>
                                       <option value="Instock">Instock</option>
                                       <option value="out-of-stock">Out of Stock</option>
                                       <option value="backorder">Backorder</option>
                                                  
                                   </select>
                        </div>

                        
                        <div class="mb-3">
                        <label for="productUnit" class="form-label">Unit</label>
                        <select class="form-control" id="unit" name="variation_unit" >
                          <option value="N/A">--SELECT UNIT--</option>
                          <option value="piece">Piece</option>
                          <option value="box">Box</option>
                                                
                      </select>
                                                
                      </div>

                   
                      </div>
                    
                      <h6>Dimensions (L×W×H) (cm)</h6>
                      <!-- Single Product Fields -->
                       <div class="col-md-3">
                       <div class="mb-3">
                                        <label for="productVariationName" class="form-label">Weight (kg)</label>
                                        <input type="number" class="form-control" id="variation_weight" name="variation_weight"  >
                       </div>
                      </div>


                      <div class="col-md-3">
                       <div class="mb-3">

                                        <label for="productVariationName" class="form-label">Lenght</label>
                                        <input type="number" class="form-control" id="variation_length" name="variation_length"  >
                       </div>
                      </div>


                      <div class="col-md-3">
                       <div class="mb-3">

                                        <label for="productVariationName" class="form-label">Width</label>
                                        <input type="number" class="form-control" id="variation_width" name="variation_width"  >
                       </div>
                      </div>




                      <div class="col-md-3">
                       <div class="mb-3">

                                        <label for="productVariationName" class="form-label">Height</label>
                                        <input type="number" class="form-control" id="variation_height" name="variation_height"  >
                       </div>
                      </div>
                   



                                            <div class="col-md-12">
                          <div class="mb-3">
                              <label for="productDescription" class="form-label">Description</label>
                              <textarea class="form-control" id="productDescription" name="variation_description" rows="4" placeholder="Enter product description"></textarea>
                          </div>
                          <div class="text-end">
                              <button type="button" class="btn btn-danger remove-variation">Remove</button>
                          </div>
                      </div>                      


                    </div>
                  </div>
           
                </div>
          

                <!-- Submit Button -->
                <div class="mb-3">
                  <button type="submit" class="btn btn-primary w-100">Register Product</button>
                </div>
              </form>
            </div>

</div>
</div>





        </div>
     <div class="col-lg-4 col-md-6">
    <div class="card h-100">
        <div class="card-header pb-0">
            <h6>Product Overview</h6>
            <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                <span class="font-weight-bold">Recent Products</span>
            </p>
        </div>
        <div class="card-body p-3">
            <div class="timeline timeline-one-side">
                <?php
                    include("connection.php");
                // Fetch registered products
                $sql = "SELECT product_name, type, created_at FROM products ORDER BY created_at DESC LIMIT 6";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Loop through products
                    while ($row = $result->fetch_assoc()) {
                        $name = htmlspecialchars($row['product_name']);
                        $type = htmlspecialchars($row['type']);
                  
                        $created_at = htmlspecialchars($row['created_at']);
                        ?>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-box-2 text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    <?php echo "$name ($type)"; ?>
                                </h6>
                              
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    Added on: <?php echo date('d M Y, h:i A', strtotime($created_at)); ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // No products found
                    ?>
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-box-2 text-danger text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">No products registered</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Register new products to see them here.</p>
                        </div>
                    </div>
                    <?php
                }

                // Close the connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>
<?php
      include("footer.php");
?>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->     
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn btn-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn btn-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
document.addEventListener("DOMContentLoaded", function () {
    fetchNextQRCode();
    generateSlug();
    enableRemoveButtons();
});

// Add new variation form
const addValueBtn = document.getElementById("addValueBtn");
if (addValueBtn) {
    addValueBtn.addEventListener("click", function () {
        const variationsContainer = document.getElementById("productVariations");
        const originalForm = document.querySelector(".variation-form");
        
        if (!originalForm) {
            console.error("No variation-form found!");
            return;
        }

        const newForm = originalForm.cloneNode(true);
        newForm.querySelectorAll("input, textarea").forEach(input => input.value = "");
        variationsContainer.appendChild(newForm);
        enableRemoveButtons();
    });
}

// Enable remove button functionality
function enableRemoveButtons() {
    document.querySelectorAll(".remove-variation").forEach(button => {
        button.onclick = function () {
            const formToRemove = this.closest(".variation-form");
            if (document.querySelectorAll(".variation-form").length > 1) {
                formToRemove.remove();
            } else {
                alert("At least one variation is required.");
            }
        };
    });
}

// Handle product registration form submission
$(document).ready(function () {
    $('#productRegistration').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let isVariation = $('#pills-variation-tab').hasClass('active');
        formData.append("variation", isVariation ? "true" : "false");

        $.ajax({
            type: 'POST',
            url: 'process/product-registration.php',
            data: formData,
            contentType: false,
            processData: false,
            success: handleRegistrationResponse,
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error, "Status:", status, "XHR:", xhr);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while registering the product.',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            }
        });
    });
});

function handleRegistrationResponse(response) {
    console.log("RAW RESPONSE:", response);
    try {
        let jsonResponse = typeof response === "string" ? JSON.parse(response) : response;
        if (jsonResponse.status === "success") {
            Swal.fire({
                title: 'Success!',
                text: jsonResponse.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => window.location.reload());
            $('#productRegistration')[0].reset();
        } else {
            Swal.fire({
                title: 'Error',
                text: jsonResponse.message || "Something went wrong!",
                icon: 'error',
                confirmButtonText: 'Try Again'
            });
        }
    } catch (e) {
        console.error("JSON Parsing Error:", e, "Response:", response);
        Swal.fire({
            title: 'Error',
            text: 'An unexpected error occurred. Check console for details.',
            icon: 'error',
            confirmButtonText: 'Try Again'
        });
    }
}

// Fetch product attributes
function productAttrib() {
    const variationName = document.getElementById("productVariationDropdown").value;
    const button = document.getElementById("addValueBtn");
    const dropdown = document.getElementById("attributeValuesDropdown");

    $.ajax({
        type: 'GET',
        url: 'fetch/productAttribute-value.php',
        data: { variationName },
        success: function (response) {
            console.log(response);
            dropdown.innerHTML = "";
            
            if (response.values?.length) {
                button.disabled = false;
                dropdown.innerHTML = `<option value="">Select an option</option>` +
                    response.values.map(item => `<option value="${item.id}">${item.value}</option>`).join('');
            } else {
                console.error("No values found", response);
                button.disabled = true;
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, "-", error);
            if (!dropdown.options.length) button.disabled = true;
        }
    });
}

// Show uploaded product image instantly
const productImageInput = document.getElementById("productImage");
if (productImageInput) {
    productImageInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        const showImage = document.getElementById("showImage");
        if (file) {
            const reader = new FileReader();
            reader.onload = e => showImage.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" width="150">`;
            reader.readAsDataURL(file);
        } else {
            showImage.innerHTML = "";
        }
    });
}

// Generate Slug from Name
function generateSlug() {
    const name = document.getElementById('productName')?.value.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
    if (name) document.getElementById('slug').value = name;
}

// Fetch Next QR Code and Update Image
function fetchNextQRCode() {
    fetch('fetch/barcode_registration.php')
        .then(response => response.json())
        .then(data => {
            let nextNumber = (data.last_qrcode ? parseInt(data.last_qrcode, 10) : 1000000000) + 1;
            document.getElementById("qrcode").value = nextNumber;
            generateQRCode(nextNumber);
        })
        .catch(error => console.error("Error fetching QR code:", error));
}

// Generate QR Code Image
function generateQRCode(qrText) {
    document.getElementById("qrcodeImage").src = `https://quickchart.io/qr?text=${qrText}&size=150&t=${Date.now()}`;
}

// Enable scrollbar for Windows users
if (navigator.platform.includes('Win')) {
    const sidenavScrollbar = document.querySelector('#sidenav-scrollbar');
    if (sidenavScrollbar) Scrollbar.init(sidenavScrollbar, { damping: '0.5' });
}

</script>


  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>