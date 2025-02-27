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
        <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
        <div class="card">
  <div class="card-header pb-0">
    <h6>Attributes</h6>
    <p class="text-sm mb-0">Fill in the details below to register your attributes.</p>
  </div>
  <div class="card-body px-4 pb-4">
    <form  id="registrationForm" method="POST">
      <div class="mb-3">
        <label for="productName" class="form-label">Name</label>
        <input type="text" class="form-control" id="Name" name="name" placeholder="Enter name" oninput="generateSlug()" required>
      </div>
      <div class="mb-3">
        <label for="productCode" class="form-label">Slug</label>
        <input type="text" class="form-control" id="slug"name="slug" placeholder="Slug" required>
      </div>
      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select class="form-control" name="type" id="type" required>
            <option disabled>Select</option>
            <option value="Color" >Color</option>
            <option value="Image" >Image</option>
            <option value="Label" >Label</option>
            <option value="Button" >Button</option>
        </select>
      </div>
    
      <button type="submit" class="btn btn-primary w-100">Register Attributes</button>
    </form>
  </div>
</div>

        </div>

        <div class="col-lg-6 col-md-6">
  <div class="card h-100">
    <div class="card-header pb-0">
      <h6 class="mb-0">Attributes and Values</h6>
    </div>
    <div class="card-body p-3">
      <div class="timeline timeline-one-side" id="attributesContainer">
        <?php
        include("connection.php");

        // Fetch attributes and their values from the database
        $sql = "SELECT a.id, a.attribute_name, a.slug, a.type, 
        GROUP_CONCAT(v.value ORDER BY v.id ASC SEPARATOR ', ') AS `values`
 FROM attributes a
 LEFT JOIN attribute_values v ON a.id = v.attribute_id
 GROUP BY a.id ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-folder-17 text-primary text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">' . htmlspecialchars($row['attribute_name']) . '</h6>
                <p class="text-secondary text-xs mt-1 mb-0">
                  Slug: ' . htmlspecialchars($row['slug']) . '<br>
                  Type: ' . htmlspecialchars($row['type']) . '
                </p>
                <p class="text-secondary text-xs mt-1 mb-0">
                  Values: ' . (!empty($row['values']) ? htmlspecialchars($row['values']) : 'No values added yet') . '
                </p>
                <button 
                  class="btn btn-sm btn-success mt-2 add-value-btn" 
                  data-id="' . $row['id'] . '" 
                  data-name="' . htmlspecialchars($row['attribute_name']) . '">
                  Add Values
                </button>
              </div>
            </div>';
          }
        } else {
          echo '<p class="text-secondary text-xs mt-1 mb-0">No attributes found.</p>';
        }

        // Close connection
        $conn->close();
        ?>
      </div>
    </div>
  </div>
</div>
<!-- Modal for Adding Values -->
<div class="modal fade" id="addValueModal" tabindex="-1" aria-labelledby="addValueModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addValueModalLabel">Add Values for Attribute</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addValueForm" method="POST" action="process/insert-values.php">
        <div class="modal-body">
          <!-- Hidden input to store attribute ID -->
          <input type="hidden" name="attribute_id" id="attributeId">

          <!-- Display the attribute name -->
          <div class="mb-3">
            <label for="attributeName" class="form-label">Attribute Name</label>
            <input type="text" class="form-control" id="attributeName" name="attribute_name" readonly>
          </div>

          <!-- Container for value fields -->
          <div id="valuesContainer">
            <div class="mb-3 value-field">
              <label for="value" class="form-label">Value</label>
              <input type="text" class="form-control" name="values[]" placeholder="Enter value" required>
            </div>
          </div>

          <!-- Button to add more value fields -->
          <button type="button" class="btn btn-secondary w-100 mt-2" id="addFieldButton">Add Another Value</button>
        </div>

        <!-- Modal footer with submit button -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Values</button>
        </div>
      </form>
    </div>
  </div>
</div>



      </div>

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
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

document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('addValueModal'));
    const valuesContainer = document.getElementById('valuesContainer');
    const addFieldButton = document.getElementById('addFieldButton');
    const attributesContainer = document.getElementById('attributesContainer');

    document.querySelectorAll('.add-value-btn').forEach(button => {
      button.addEventListener('click', function () {
        const attributeId = this.getAttribute('data-id');
        const attributeName = this.getAttribute('data-name');

        // Populate modal fields
        document.getElementById('attributeId').value = attributeId;
        document.getElementById('attributeName').value = attributeName;

        // Clear existing fields
        valuesContainer.innerHTML = `
          <div class="mb-3 value-field">
            <label for="value" class="form-label">Value</label>
            <input type="text" class="form-control" name="values[]" placeholder="Enter value" required>
          </div>
        `;

        // Show the modal
        modal.show();
      });
    });

    addFieldButton.addEventListener('click', function () {
      const newField = document.createElement('div');
      newField.classList.add('mb-3', 'value-field');
      newField.innerHTML = `
        <label for="value" class="form-label">Value</label>
        <input type="text" class="form-control" name="values[]" placeholder="Enter value" required>
      `;
      valuesContainer.appendChild(newField);
    });

    // Handle the form submission to update the attributes container
    // document.getElementById('addValueForm').addEventListener('submit', function (e) {
    //   e.preventDefault();

    //   const formData = new FormData(this);

    //   fetch('fetch/fetch-values.php', {
    //     method: 'POST',
    //     body: formData,
    //   })
    //     .then(response => response.text())
    //     .then(data => {
    //       // Refresh the attributes container
    //       attributesContainer.innerHTML = data;

    //       // Hide the modal
    //       modal.hide();
    //     })
    //     .catch(error => console.error('Error:', error));
    // });
  });

function generateSlug() {
    var name = document.getElementById('Name').value;
    var slug = name.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
    document.getElementById('slug').value = slug;
  }

  $('#registrationForm').on('submit', function(e) {
      e.preventDefault();
      var formData = $(this).serialize();

      $.ajax({
          type: 'POST',
          url: 'process/attributes-registration.php',
          data: formData,
          success: function(response){
            $('#registrationForm')[0].reset();
       
            Swal.fire({
                        title: 'Success!',
                        text: 'Attributes Registered Successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Refresh the page
                          window.location.reload();
                        }
                      });
           
          },
          error: function(xhr, status, error){
            Swal.fire({
                title: 'Error',
                text: 'An error occured while registering attributes.',
                icon: 'Error',
                confirmButtonText: 'Try Again'
            });
          }
      });
  });



    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.1.0"></script>
</body>

</html>