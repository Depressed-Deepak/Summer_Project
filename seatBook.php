<!DOCTYPE html>
<html lang="en">

<?php
include('connection.php');
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    // Split the full name by space
    $nameParts = explode(' ', $_SESSION['username']);

    // Get the first part of the name (the first name)
    $firstName = strtoupper($nameParts[0]);

    $sql = "SELECT Phone_Number FROM db_table WHERE username = '{$_SESSION['username']}'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the result into an associative array
        $row = mysqli_fetch_assoc($result);

        // Check if a row was found
        if ($row) {
            // Access the Phone_Number column from the $row array
            $phoneNumber = $row['Phone_Number'];
        } else {
            // No matching user found
            echo "No user found with that username.";
        }
    } else {
        // Query failed
        echo "Error: " . mysqli_error($conn);
    }
}
$selectedSeats = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Storing the message in a local variable
    $message = "Congratulations!! Your data has been recorded.";

    // Retrieve the selected value of seats from the form submission
    $selectedSeats = $_POST['seats'];

    // Construct the SQL query
    $sql2 = "INSERT INTO seat_db (`Name`, `Phone_Number`, `No_of_Seats`) VALUES ('$username', '$phoneNumber', '$selectedSeats')";

    // Execute the query
    if (mysqli_query($conn, $sql2)) {
        // Display an alert message
        echo "<script>alert('$message')</script>";
        // Redirect to another page
        echo '<script>window.location.href = "userOrAdmin.php";</script>';
        exit(); // Ensure that no other code is executed after the redirection
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Number of Seats</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('pictures/hostel_image.jpg');
            background-size: cover;
            /* background-position: center;     */
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            appearance: none;
            background-color: #fff;
            font-size: 16px;
            color: #333;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><?php echo "Hello " . $firstName ?>, Please Select Number of Seats</h2>
        <form action="" method="post">
            <label for="seats">Number of Seats: <?php echo $phoneNumber ?> </label>
            <select name="seats" id="seats">
                <option value="1" <?php if ($selectedSeats == "1") echo "selected"; ?>>1</option>
                <option value="2" <?php if ($selectedSeats == "2") echo "selected"; ?>>2</option>
                <option value="3" <?php if ($selectedSeats == "3") echo "selected"; ?>>3</option>
                <option value="4" <?php if ($selectedSeats == "4") echo "selected"; ?>>4</option>
                <option value="5" <?php if ($selectedSeats == "5") echo "selected"; ?>>5</option>
                <!-- Add more options as needed -->
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>