    <!-- <div class="col-lg-6 col-md-6">
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
                $sql = "SELECT name, category, price, created_at FROM products ORDER BY created_at DESC LIMIT 6";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Loop through products
                    while ($row = $result->fetch_assoc()) {
                        $name = htmlspecialchars($row['name']);
                        $category = htmlspecialchars($row['category']);
                        $price = htmlspecialchars($row['price']);
                        $created_at = htmlspecialchars($row['created_at']);
                        ?>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="ni ni-box-2 text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    <?php echo "$name ($category)"; ?>
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    Price: $<?php echo $price; ?>
                                </p>
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
        </div> -->