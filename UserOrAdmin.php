<?php
$url = 'pictures/newimage.png'; // Replace with the actual path to your image
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio Buttons Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-image: url('<?php echo $url; ?>');
            background-size: cover;
            align-items: center;
            display: flex;
            
        }

        .rectangle-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 200px;
            background-color: rgba(0, 0, 1, 0.7);
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin: 10px 0;
            font-size: 18px;
        }

        input[type="radio"] {
            display: none;
        }

        .radio-label {
            cursor: pointer;
            padding: 10px 20px;
            border: 2px solid #3498db;
            color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        input[type="radio"]:checked + .radio-label {
            background-color: #3498db;
            color: #fff;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            opacity: 0.7; /* Initial opacity */
        }

        input[type="submit"]:disabled {
            opacity: 0.5; /* Opacity when disabled */
        }
    </style>
</head>

<body>

    <div class="rectangle-container">
        <form id="myForm" action="process.php" method="post">
           
            <input type="radio" id="user" name="userType" value="user" onclick="enableSubmit()">
            <label for="user" class="radio-label">
                User
            </label>
            <input type="radio" id="admin" name="userType" value="admin" onclick="enableSubmit()">
                <label for="admin" class="radio-label">
                Admin
            </label>

            <input type="submit" id="submitButton" value="Submit" onclick="submit()" disabled>
        </form>

      
    </div>
    <div style="font-weight: bold; font-size: larger; position: absolute; bottom: 20px;">
    If SuperAdmin, <span style="background-color: orange; color: blue;"><a href="superadminLogin.php" style="color: inherit;">Click Here</a></span>
</div>


<script>
    function enableSubmit() {
        var userRadio = document.getElementById('user');
        var adminRadio = document.getElementById('admin');
        var submitButton = document.getElementById('submitButton');

        if (userRadio.checked || adminRadio.checked) {
            submitButton.disabled = false;
            submitButton.style.opacity = 1;
        } else {
            submitButton.disabled = true;
            submitButton.style.opacity = 0.5;
        }
    }

    document.getElementById('myForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevents the default form submission

        var userRadio = document.getElementById('user');
        var adminRadio = document.getElementById('admin');

        var userType; // Corrected

        // Loop through radio buttons to check which one is selected
        if (userRadio.checked) {
            userType = userRadio.id;
        } else if (adminRadio.checked) {
            userType = adminRadio.id;
        }

        // Open different webpages based on the selected user type
        if (userType === 'user') {
            window.location.href = 'userLogin.php';
        } else if (userType === 'admin') {
            window.location.href = 'adminLogin.php';
        }
    });
</script>

</body>

</html>
