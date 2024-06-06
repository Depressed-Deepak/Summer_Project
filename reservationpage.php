<?php
include 'connection.php';
session_start();

$username = $_SESSION['username'];

// Fetch phone number based on username
$phone = null;
$sql_phone = "SELECT Phone_Number FROM seat_db WHERE Username = ?";
$stmt_phone = $conn->prepare($sql_phone);
$stmt_phone->bind_param('s', $username);
$stmt_phone->execute();
$result_phone = $stmt_phone->get_result();

if ($result_phone->num_rows > 0) {
    $row = $result_phone->fetch_assoc();
    $phone = $row['Phone_Number'];
}

$stmt_phone->close();

// Check if the phone number exists in the db_table
$phoneExists = false;
if ($phone) {
    $my_query = "SELECT * FROM seat_db WHERE Phone_Number = ?";
    $stmt = $conn->prepare($my_query);
    $stmt->bind_param('s', $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $phoneExists = true;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            object-fit: fill;
            text-align: center;
            margin: 0;
            overflow: hidden;
            /* Prevent scrolling */
            background-image: url('pictures/newseat.jpg');
        }

        header {
            padding-top: 0px;
            /* Move the padding from body to header */
            height: 50px;
        }

        nav {
            background-color: #4CAF50;
            overflow: hidden;
            justify-content: space-between;
            align-items: center;
            padding: 0px;
            height: 50px;
        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 6px 8px;
            text-decoration: none;
            margin-left: 14px;
            margin-top: 8px;
            font-weight: bold;
            font-size: medium;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: fit-content;
            margin: 0 auto;
            margin-top: 230px;
            padding: 20px;
            background-color: burlywood;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            opacity: 1;
            font-weight: bold;
            font-size: 10px;
            font-family: poppins;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .button-container {
            margin-top: 30px;
        }

        .button-container button {
            padding: 12px 15px;
            margin: 10px;
            font-size: 18px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .button-container .delete-btn {
            background-color: #dc3545;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .button-container .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="contact.php">Contact us</a>
            <a href="aboutUs.php">About Us</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?><br>What would you like to do?</h1>

        <div class="button-container">
            <button onclick="makeReservation()">Make Reservation</button>
            <button class="delete-btn" onclick="editReservation()">Edit Reservation</button>
        </div>
    </div>

    <script>
        var phoneExists = <?php echo json_encode($phoneExists); ?>;

        function makeReservation() {
            console.log('makeReservation called');
            if (phoneExists) {
                alert('Phone number is already in use');
            } else {
                window.location.href = 'seatBook.php';
            }
        }

        function editReservation() {
            console.log('editReservation called');
            if (phoneExists) {
                window.location.href = 'editPage.php';
            } else {
                alert('No record was found.');
            }
        }
    </script>

</body>

</html>