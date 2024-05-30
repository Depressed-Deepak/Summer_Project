<?php
session_start();
include('connection.php');

// Initialize response
$response = array("status" => "error", "message" => "An unknown error occurred.");

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Split the full name by space
    $nameParts = explode(' ', $_SESSION['username']);

    // Get the first part of the name (the first name)
    $firstName = strtoupper($nameParts[0]);

    // Create the SQL delete query
    $sql = "DELETE FROM seat_db WHERE Name = ?";

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the username parameter to the query
        mysqli_stmt_bind_param($stmt, "s", $username);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Check the number of affected rows
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Success
                $response = array("status" => "success", "message" => "Reservation deleted successfully.");
            } else {
                // No rows affected, meaning no matching reservation was found
                $response = array("status" => "error", "message" => "No matching reservation found to delete.");
            }
        } else {
            // Error
            $response = array("status" => "error", "message" => "Error executing query: " . mysqli_stmt_error($stmt));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $response = array("status" => "error", "message" => "Error preparing statement: " . mysqli_error($conn));
    }

    // Close the connection
    mysqli_close($conn);
} else {
    $response = array("status" => "error", "message" => "No username found in session.");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('pictures/reserveback.jpg');
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .button-container {
            display: flex;
            gap: 20px;
        }

        button {
            padding: 15px 30px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $firstName ."<br>What would you like to do ?"?><h1>
    
    <div class="button-container">
        <button onclick="makeReservation()">Make Reservation</button>
        <button class="delete-btn" onclick="deleteReservation()">Delete Reservation</button>
    </div>

    <script>
        function makeReservation() {
            window.location.href = 'seatBook.php';
        }

        function deleteReservation() {
            if (confirm('Are you sure you want to delete your reservation?')) {
                // Make an AJAX request to deleteReservation.php
                fetch('deleteReservation.php', {
                    method: 'POST',
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging line to check the response
                    alert(data.message);
                    if (data.status === 'success') {
                        // Optionally, redirect to another page or update the UI
                        window.location.href = 'index.php'; // or any other page
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Reservation deleted successfully.');
                    window.location.href = 'UserOrAdmin.php';
                });
            }
        }
    </script>
</body>
</html>
