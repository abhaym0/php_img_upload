<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>

<h2>Upload an Image</h2>
<form  method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">Upload</button>
</form>

</body>
</html>

<?php

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'test2');

// Check if the connection is successful
if(!$db) {
    echo 'Database connection failed';
} else {
    // Check if a file is uploaded
    if(isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // File details
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        // Check if file has no errors
        if($fileError === 0) {
            // Move the uploaded file to a directory (uploads/)
            $targetDir = 'uploads/';
            $targetFile = $targetDir . $fileName;
            move_uploaded_file($fileTmpName, $targetFile);
            $imgId = uniqid();
            // Insert image path into the database
            $sql = "INSERT INTO img2 (id,url) VALUES ('$imgId','$targetFile')";
            $result = mysqli_query($db, $sql);

            if($result) {
                echo 'Image uploaded successfully';
            } else {
                echo 'Failed to upload image';
            }
        } else {
            echo 'Error uploading file';
        }
    }
}

?>
