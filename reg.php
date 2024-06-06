
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        nav {
            background-color: #4CAF50;
            overflow: hidden;
            justify-content: space-between; /* Ensure space between elements */
            align-items: center; /* Center align items vertically */
        }
        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            margin-right: 10px; /* Add margin to create space between buttons */
        }
        nav .left-links a:last-child,
        nav .right-links a {
            margin-right: 0; /* Remove margin for the last left element and right elements */
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .table-container {
            width: 80%;
            max-width: 1200px;
            margin: 40px auto;
            overflow-x: auto;
            padding: 24px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-weight: bold;
            font-size: medium;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            table-layout: fixed;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
            word-break: break-all;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        input[type="button"] {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        input[type="button"]:hover {
            background-color: #d32f2f;
        }
        /* Add some spacing between tables */
        .table-container +.table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>Admin Page
    <nav>
        <a href="dashboard.php">Staying</a>
        <a href="logout.php">Logout</a>
    </nav>
    </header>

<?php
    // Include the database connection file
    include('connection.php');

    // Start the session
    session_start();

$sql = "SELECT * from db_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='table-container'><table><tr><th>ID</th><th>Username</th><th>Age</th><th>Email</th><th>Phone_Number</th><th>Password</th><th>Address</th><th>Occupation</th><th>Gender</th><th>Action</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["ID"]."</td><td>".$row["Username"]."</td><td>".$row["Age"]."</td><td>".$row["Email"]."</td><td>".$row["Phone_Number"]."</td><td>".$row["Password"]. "</td><td>".$row["Address"]. "</td><td>".$row["Occupation"].
            "</td><td>".$row["Gender"]."</td><td><input type=\"button\" value=\"Delete\" onclick='deleteRow(".$row["ID"].")'></td></tr>";
        }
        echo "</table></div>";
    } else {
        echo "0 results";
    }

    $conn->close();
   ?>

<script>
    function deleteRow(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "regdelete.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    location.reload(); // Refresh the page to show the updated table
                }
            };
            xhr.send("id=" + id);
        }
    }
    </script>
</body>
</html>