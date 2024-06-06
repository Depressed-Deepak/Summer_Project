<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $username = $_POST['edit_Username'];
    $phone_number = $_POST['edit_Phone_Number'];
    $no_of_sitter = $_POST['edit_No_of_Sitter'];
    $person = $_POST['edit_Person'];
    $date = $_POST['edit_Date'];

    // Validation logic
    if ($no_of_sitter < $person) {
        echo "<script>alert('Person cannot be more than the seats.');</script>";
    } else {
        $sql_update = "UPDATE seat_db 
                       SET Phone_Number = ?, No_of_Sitter = ?, Person = ?, Date = ? 
                       WHERE Username = ?";

        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('sisss', $phone_number, $no_of_sitter, $person, $date, $username);

        if ($stmt_update->execute()) {
            echo "<script>alert('Data Updated Successfully');</script>";
            echo "<script>window.location.href = 'logout.php';</script>";
        } else {
            echo "<script>alert('Error updating data.');</script>";
        }

        $stmt_update->close();
    }
}

$username = $_SESSION['username'];

// SQL query to retrieve data for the specific username
$sql = "SELECT * FROM seat_db WHERE Username = ?";

// Initialize the statement
$stmt = mysqli_stmt_init($conn);

// Check if the statement was initialized correctly
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            background-image: url('pictures/editpage.jpg');
            background-size: cover;
            align-items: center;
            display: flex;
        }

        .container {
            max-width: 1000px;
            max-height: 400px;
            margin: 200px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            opacity: 0.9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"], input[type="number"], input[type="month"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            background-color: antiquewhite;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: large;
            font-weight: bold;
            
        }

        input[type="text"]:read-only {
            background-color: #f0f0f0;
        }

        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            margin: 0 5px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Yor Data</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>No. of Sitters</th>
                    <th>Person</th>
                    <th>Date</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) {?>
                    <tr>
                        <td><input type="text" name="edit_Username" value="<?= htmlspecialchars($row['Username'])?>" readonly></td>
                        <td><input type="text" name="edit_Phone_Number" maxlength="10" value="<?= htmlspecialchars($row['Phone_Number'])?>"></td>
                        <td><input type="number" name="edit_No_of_Sitter" min="1" max="5" value="<?= htmlspecialchars($row['No_of_Sitter'])?>"></td>
                        <td><input type="number" name="edit_Person" min="1" max="5" value="<?= htmlspecialchars($row['Person'])?>"></td>
                        <td><input type="month" id="monthInput" name="edit_Date" value="<?= htmlspecialchars($row['Date'])?>"></td>
                    </tr>
                <?php }?>
            </table>
            <div class="buttons">
                <button class="button" type="submit" name="save_changes">Save Changes</button>
                <a class="button" href="logout.php">Logout</a>  
            </div>
        </form>
    </div>
</body>
<script>
    window.onload = function() {
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth() + 1;
        if (month < 10) {
            month = '0' + month;
        }
        var minDate = year + '-' + month;
        document.getElementById('monthInput').setAttribute('min', minDate);
    };
</script>

</html>
<?php
    } else {
        echo "No records found for the given username.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing the statement: ". mysqli_error($conn);
}

mysqli_close($conn);
?>
