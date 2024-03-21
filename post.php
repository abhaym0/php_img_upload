<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'userlogin');

// Check if the connection is successful
if(!$db) {
    echo 'Database connection failed';
} else {
    // Retrieve image URLs from the database
    $sql = "SELECT url FROM img";
    $result = mysqli_query($db, $sql);

    if($result) {
        // Store image URLs in an array
        $imageUrls = array();
        while($row = mysqli_fetch_assoc($result)) {
            $imageUrls[] = $row['url'];
        }
    } else {
        echo 'Failed to retrieve image URLs';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing:border-box;
        }
        .gallery{
            height:100vh;
            width:100vw;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:20px;
        }

        .gallery .img-div{
            height:300px;
            width:300px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:20px;
        }

        .img-div img{
            height:100%;
            width:100%;
            object-fit:cover;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <h2>Image Gallery</h2>
    <div class="gallery">
        <div class="img-div">
        <?php
        // Display images
        if(isset($imageUrls)) {
            foreach($imageUrls as $imageUrl) {
                echo '<img src="' . $imageUrl . '" alt="Image">';
            }
        }
        ?>
        </div>
    </div>
</body>
</html>
