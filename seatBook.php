<!DOCTYPE html>
<html lang="en">

<?php
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    // Split the full name by space
    $nameParts = explode(' ', $_SESSION['username']);

    // Get the first part of the name (the first name)
    $firstName = strtoupper($nameParts[0]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set session variables
    $_SESSION['confirmation_message'] = "Congratulations!! Your data has been entered.";

    // Storing the message in a local variable
    $message = "Congratulations!! Your data has been entered.";

    // Display an alert message
    echo '<script>alert("' . $message . '");</script>';

    // Redirect to another page
    echo '<script>window.location.href = "userOrAdmin.php";</script>';
    exit(); // Ensure that no other code is executed after the redirection
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Book </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #666666;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: pink;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333333;
        }

        p {
            text-align: center;
            color: #666666;
            font-size: 18px;
        }

        .button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            margin-top: 50px;
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            font-size: large;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .number-box {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Center the buttons horizontally */
            margin-top: 20px;
            /* Added margin to separate from the container */
        }

        .btn {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin: 0 5px;
            cursor: pointer;
        }

        input[type="text"] {
            width: 50px;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>WELCOME <?php echo $firstName . ',' ?></h1>
        <p style="font-size: larger;font-weight:bold; font-family: sans-serif;">How many seat would you like to book?</p>
        <div class="number-box">

            <button class="btn" id="decrease">-</button>
            <input type="text" id="number" value="1">
            <button class="btn" id="increase">+</button>
        </div>
    </div>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" class="button" id="enter" value="Enter">



        <table class="table" border="3px" style="color:aliceblue;">
            <thead>
                <tr>
                    <th>Seat Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Available</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Occupied</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Available</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Available</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Occupied</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <!-- <script src="SeatBookscript.js"></script> -->
        <script>
            const numberInput = document.getElementById('number');
            const increaseBtn = document.getElementById('increase');
            const decreaseBtn = document.getElementById('decrease');
            const enter = document.getElementById('enter');

            increaseBtn.addEventListener('click', () => {
                const currentValue = parseInt(numberInput.value);
                if (currentValue < 5) {
                    numberInput.value = parseInt(numberInput.value) + 1;
                }

            });

            decreaseBtn.addEventListener('click', () => {
                const currentValue = parseInt(numberInput.value);
                if (currentValue > 1) {
                    numberInput.value = currentValue - 1;
                }
            });
        </script>

        <form action="admin.php" method="post">
            <input type="hidden" name="number" value="">
            <input type="hidden" name="username" value="username">
        </form>
    </form>
</body>

</html>