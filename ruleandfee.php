<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Width Images</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
        }

        .image-container {
            flex: 1;
        }

        .image-container img {
            width: 100%;
            /* Make the images fill the height of the viewport */
            object-fit: cover; /* Ensure the images cover the container without distortion */
        }
    </style>
</head>

<body>
    <div class="image-container">
        <img src="pictures/price.jpg" alt="Image 1">
    </div>
    <div class="image-container">
        <img src="pictures/rules.png" alt="Image 2">
    </div>
</body>

</html>
