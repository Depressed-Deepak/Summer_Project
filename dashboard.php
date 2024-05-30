
<!DOCTYPE html>
<html lang="en">
<?php
// Include the database connection file
include('connection.php');

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Fetch data from the database
$sql = "SELECT * FROM db_table";
$result = mysqli_query($conn, $sql);

// Fetch data from the database
$sql2 = "SELECT * FROM seat_db";
$result2 = mysqli_query($conn, $sql2);


?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management System - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        nav {
            background-color: #555;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 80px;
            margin: 5px;
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
<body>
    <div class="container">
        <h1 style="margin-left: 400px;">Registered List</h1>
        <table border="1" style="padding : 10px; margin-left: 400px; " ;>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Occupation</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any records
                if (mysqli_num_rows($result) > 0) {
                    // Fetch each row of data from the result
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Age']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Phone_Number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Occupation']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Gender']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No reservations found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h1 style="margin-left: 400px;">Reservation List</h1>
        <table border="1" style="padding : 10px; margin-left: 400px; " ;>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone_Number</th>
                    <th>No_of_Sitter</th>
                    <th>Person</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any records
                if (mysqli_num_rows($result2) > 0) {
                    // Fetch each row of data from the result
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Phone_Number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['No_of_Sitter']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Person']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No reservations found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
    <footer>
        &copy; <?php echo date("Y"); ?> Hostel Management System
    </footer>

</body>

</html>
