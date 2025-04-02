<?php include("../layout/header.php"); ?>
<style>

</style>

<body class="g-sidenav-show bg-gray-100">

  <?php include("aside.php"); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

  
    <?php include("topnav.php"); ?>
    <div class="container-fluid py-4">
   




    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Authors table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              <?php


// Fetch product details from the database
$sql = "SELECT P.* 

FROM products AS P";
$result = $conn->query($sql);
?>

<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Brand</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QR Code</th>
            <th class="text-secondary opacity-7">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="process/<?= htmlspecialchars($row['image']) ?>" class="avatar avatar-sm me-3" alt="<?= htmlspecialchars($row['name']) ?>">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= htmlspecialchars($row['name']) ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($row['slug']) ?> </p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($row['brand_id']) ?></p>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm bg-gradient-secondary"><?= htmlspecialchars($row['category_id']) ?></span>
                </td>
                <td class="align-middle text-center">
                    <img src="process/<?= htmlspecialchars($row['qr_code_image']) ?>" width="50">
                    <span class="text-secondary text-xs font-weight-bold"><?= htmlspecialchars($row['product_qr']) ?></span>

                </td>
                <td class="align-middle">
                
                    <a class="btn bg-gradient-primary mb-0" href="product-info.php?id=<?= $row['id'] ?>"><i class="fas fa-plus"></i>&nbsp;&nbsp;View</a>

                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

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


</body>
</html>
