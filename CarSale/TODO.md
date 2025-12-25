# TODO: Add Validations to upload_product.php

- [x] Add checks for required POST fields (product_name, product_price, product_description, product_category, fuel_type) to ensure they are set and not empty.
- [x] Validate product_price: must be numeric and greater than 0.
- [x] Validate product_description: limit to 500 words using str_word_count.
- [x] Validate image file: check if uploaded without error, MIME type is image, size < 5MB.
- [x] Sanitize all inputs using mysqli_real_escape_string.
- [x] If any validation fails, redirect to admin_products.php with error message (e.g., msg=3).
- [x] If all validations pass, proceed with file upload and database insert as before.
- [x] Test the upload functionality after changes.
