<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=sample', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch attributes from the database
$attributesStmt = $pdo->query("SELECT * FROM attributes");
$attributes = $attributesStmt->fetchAll(PDO::FETCH_ASSOC);



// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get product details
    $name = $_POST['name'];
    $description = $_POST['description'];
    $productType = $_POST['product_type'];  // Single or Variation product
    $attribute = $_POST['attribute'];

    // Insert product (without price and SKU initially)
    $stmt = $pdo->prepare("INSERT INTO products (name, description, product_type, attributes) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $productType, $attribute]);
    $productId = $pdo->lastInsertId();  // Get inserted product ID

    // If it's a product with variations, insert variations
    if ($productType == 'variation' && isset($_POST['variations'])) {
        foreach ($_POST['variations'] as $variation) {
            $value = $variation['value'];
            $variation_price = $variation['price'];
            $variation_sku = $variation['sku'];
      

            // Insert variation into the database
            $stmt = $pdo->prepare("INSERT INTO product_variations (product_id, value, price, sku) 
                                   VALUES (?, ?, ?, ?)");
            $stmt->execute([$productId, $value, $variation_price, $variation_sku]);
        }
    } else {
        // If it's a single product, update with price and SKU
        $price = $_POST['price'];
        $sku = $_POST['sku'];

        $stmt = $pdo->prepare("UPDATE products SET price = ?, sku = ? WHERE id = ?");
        $stmt->execute([$price, $sku, $productId]);
    }
}



?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Product Form -->
<form action="" method="POST">
    <h3>Product Information</h3>

    <!-- Tab Pills Navigation -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-single-tab" data-bs-toggle="pill" href="#single-product" role="tab">Single Product</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-variation-tab" data-bs-toggle="pill" href="#product-variations" role="tab">Product Variation</a>
        </li>
    </ul>

    <!-- Hidden Input for Validation -->
    <input type="hidden" name="product_type" id="selected_tab" value="single">

    <label for="name">Product Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br><br>

    <!-- Tab Content -->
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="single-product" role="tabpanel">
            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01"><br><br>

            <label for="sku">Product SKU:</label>
            <input type="text" name="sku"><br><br>
        </div>

        <div class="tab-pane fade" id="product-variations" role="tabpanel">
            <h3>Product Variations</h3>
            <div id="variations">
                <div class="variation">
                    <label for="attribute">Attribute:</label>
                    <select name="variations[0][attribute]" id="attribute" onchange="loadValues(this)" required>
                        <option selected disabled>--SELECT ATTRIBUTE--</option>
                    </select><br>

                    <label for="value">Value:</label>
                    <select name="variations[0][value]" id="value" ></select>

                    <label for="variation_price">Price:</label>
                    <input type="number" name="variations[0][price]" step="0.01" >

                    <label for="variation_sku">SKU:</label>
                    <input type="text" name="variations[0][w1]" ><br><br>
                </div>
            </div>
            <button type="button" id="add-value-btn">Add Another Value</button>
        </div>
    </div>

    <button type="submit">Submit Product</button>
</form>

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadAttributes();
    document.querySelectorAll('#pills-tab a[data-bs-toggle="pill"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (event) {
            document.getElementById("selected_tab").value = event.target.id.includes("single") ? "single" : "variation";
        });
    });
});

let variationIndex = 1;

function loadAttributes() {
    fetch('fetch_attributes.php')
        .then(response => response.json())
        .then(data => {
            const attributesSelect = document.getElementById("attribute");
            attributesSelect.innerHTML = '<option selected disabled>--SELECT ATTRIBUTE--</option>';
            data.forEach(attribute => {
                const option = document.createElement('option');
                option.value = attribute.id;
                option.text = attribute.attribute_name;
                attributesSelect.appendChild(option);
            });
        });
}

function loadValues(attributeSelect) {
    const attributeId = attributeSelect.value;
    const valueSelect = attributeSelect.parentElement.querySelector("select[name*='[value]']");
    
    fetch(`fetch_values.php?attribute_id=${attributeId}`)
        .then(response => response.json())
        .then(data => {
            valueSelect.innerHTML = '<option selected disabled>--SELECT VALUE--</option>';
            data.forEach(value => {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.value;
                valueSelect.appendChild(option);
            });
        });
}

function addValue() {
    const attributeSelect = document.getElementById("attribute");
    if (!attributeSelect.value) {
        alert("Please select an attribute first.");
        return;
    }

    let newVariation = document.createElement('div');
    newVariation.classList.add('variation');
    
    newVariation.innerHTML = `
        <label>Value:</label>
        <select name="variations[${variationIndex}][value]" required>
            <option selected disabled>--SELECT VALUE--</option>
        </select>
        <label>Price:</label>
        <input type="number" name="variations[${variationIndex}][price]" step="0.01" required>
        <label>SKU:</label>
        <input type="text" name="variations[${variationIndex}][sku]" required><br><br>
        <button type="button" onclick="removeVariation(this)">Remove</button><br><br>
    `;

    const valueSelect = newVariation.querySelector("select[name*='[value]']");
    fetch(`fetch_values.php?attribute_id=${attributeSelect.value}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(value => {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.value;
                valueSelect.appendChild(option);
            });
        });

    document.getElementById('variations').appendChild(newVariation);
    variationIndex++;
}

function removeVariation(button) {
    button.closest('.variation').remove();
    variationIndex--;
}

document.getElementById('add-value-btn').addEventListener('click', addValue);
</script>
