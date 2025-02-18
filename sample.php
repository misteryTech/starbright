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

    // Insert product (without price and SKU initially)
    $stmt = $pdo->prepare("INSERT INTO products (name, description, product_type) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $productType]);
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


<!-- Product Form with Option for Single or Variation Product -->
<form action="" method="POST">
    <h3>Product Information</h3>

    <label for="product_type">Product Type:</label>
    <input type="radio" name="product_type" value="single" checked onclick="toggleVariationFields()"> Single Product
    <input type="radio" name="product_type" value="variation" onclick="toggleVariationFields()"> Product with Variations<br><br>

    <label for="name">Product Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br><br>


    <div id="single-product-fields">
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01"><br><br>

        <label for="sku">Product SKU:</label>
        <input type="text" name="sku"><br><br>
    </div>

    <!-- Variations Section (Hidden by Default for Single Product) -->  
    <div id="variations-section" style="display:none;">
        <h3>Product Variations</h3>
        <div id="variations">
            <div class="variation">
                <label for="attribute">Attribute:</label>
                <select name="variations[0][attribute]" id="attribute" onchange="loadValues(this)" required>
                    <option selected>--SELECT ATTRIBUTE</option>
                </select><br>

                <label for="value">Value:</label>
                <select name="variations[0][value]" id="value" required>
                    <!-- Dynamically populated values for the selected attribute will be inserted here -->
                </select>

                <label for="variation_price">Price:</label>
                <input type="number" name="variations[0][price]" step="0.01" required>

                <label for="variation_sku">SKU:</label>
                <input type="text" name="variations[0][sku]" required><br><br>
            </div>
        </div>
        <button type="button" id="add-value-btn">Add Another Value</button>
    </div>

    <button type="submit">Submit Product</button>
</form>

<script>// Initialize page
// Initialize page
document.addEventListener("DOMContentLoaded", function () {
    toggleVariationFields();
    loadAttributes();
});

// Initialize variationIndex to track the number of variations
let variationIndex = 1; // Start at 1 because the first variation is already created in the form

// Toggle variation fields based on product type
function toggleVariationFields() {
    const productType = document.querySelector('input[name="product_type"]:checked').value;
    document.getElementById('variations-section').style.display = productType === 'variation' ? 'block' : 'none';
     
    if (productType === 'variation') {
        document.getElementById('variations-section').style.display = 'block';
        document.getElementById('single-product-fields').style.display = 'none';
    } else {
        document.getElementById('variations-section').style.display = 'none';
        document.getElementById('single-product-fields').style.display = 'block';
    }
    
}

// Fetch attributes and populate the attribute select dropdown
function loadAttributes() {
    fetch('fetch_attributes.php')
        .then(response => response.json())
        .then(data => {
            const attributesSelect = document.querySelector("select[name='variations[0][attribute]']");
            attributesSelect.innerHTML = '<option selected disabled>--SELECT ATTRIBUTE--</option>';
            data.forEach(attribute => {
                const option = document.createElement('option');
                option.value = attribute.id;
                option.text = attribute.attribute_name;
                attributesSelect.appendChild(option);
            });

            // Add event listener for changing attributes
            attributesSelect.addEventListener('change', () => {
                loadValues(attributesSelect); // Load values based on selected attribute
                resetVariations(); // Reset added variations when the attribute changes
            });
        });
}

// Fetch values for the selected attribute
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

// Reset added variations when the attribute is changed
function resetVariations() {
    // Clear all variations except the first one
    const variationsContainer = document.getElementById('variations');
    const variations = variationsContainer.querySelectorAll('.variation');
    for (let i = 1; i < variations.length; i++) {
        variations[i].remove();
    }
    variationIndex = 1; // Reset the variation index to 1 (to prevent index conflicts)
}
// Add new value dynamically based on the selected attribute
function addValue() {
    const attributeSelect = document.querySelector("select[name='variations[0][attribute]']");
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

    // Populate the value dropdown for the new variation with the selected attribute's values
    const selectedAttributeId = attributeSelect.value;
    const valueSelect = newVariation.querySelector("select[name*='[value]']");
    fetch(`fetch_values.php?attribute_id=${selectedAttributeId}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(value => {
                const option = document.createElement('option');
                option.value = value.id;
                option.text = value.value;
                valueSelect.appendChild(option);
            });

            // Remove the options that have already been selected in previous variations
            updateValueSelectOptions(valueSelect);
        });

    // Add the new variation to the form
    document.getElementById('variations').appendChild(newVariation);
    variationIndex++; // Increment the index for the next variation
}

// Remove a variation
function removeVariation(button) {
    // Find the parent element (the variation div) and remove it
    const variation = button.closest('.variation');
    variation.remove();
    variationIndex--; // Decrement the index to reflect the removal
}



// Update the value select options to ensure previously selected values are removed
function updateValueSelectOptions(valueSelect) {
    // Get all options in all variations (already added)
    const selectedValues = [];
    const allVariations = document.querySelectorAll("select[name*='[value]']");
    
    allVariations.forEach(select => {
        const selectedOption = select.value;
        if (selectedOption) {
            selectedValues.push(selectedOption);
        }
    });

    // Disable the selected options to avoid duplicate selections
    Array.from(valueSelect.options).forEach(option => {
        if (selectedValues.includes(option.value)) {
            option.disabled = true; // Disable the option
        } else {
            option.disabled = false; // Enable the option if not selected
        }
    });
}

document.getElementById('add-value-btn').addEventListener('click', addValue);

</script>
