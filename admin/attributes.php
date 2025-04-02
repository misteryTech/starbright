<?php include("../layout/header.php"); ?>

<body class="g-sidenav-show  bg-gray-100">

<?php include("aside.php"); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include("topnav.php"); ?>
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
  <?php
    if (isset($_SESSION['success'])) {
        echo '<div id="success-message" class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); // Remove message after displaying
    }
    ?>

    
    <form  id="registrationForm" method="POST">
      <div class="mb-3">
        <label for="productName" class="form-label">Brand Name</label>
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
            <option value="School-Supplies" >School and Supplies</option>
     
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
            <label for="attributeName" class="form-label">Brand Name</label>
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


      <?php include("footer.php"); ?>
    </div>
  </main>
  <?php include("fixed-plugin.php"); ?>
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