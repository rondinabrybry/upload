<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadFile = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    if ($uploadFile && $imageType) {
        // Read the image file into a variable
        $imageData = file_get_contents($uploadFile);

        // Save image data to the database
        $pdo = new PDO('mysql:host=localhost;dbname=image_upload_db', 'root', '');
        $stmt = $pdo->prepare("INSERT INTO images (image_data, image_type) VALUES (?, ?)");
        $stmt->bindParam(1, $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(2, $imageType);
        $stmt->execute();
    } else {
        echo 'Error uploading the image.';
    }
}

// Serve the HTML page with the uploaded image
include 'index.html';
?>