<?php
include('connection.php');
session_start();

$username = $_SESSION['username'];

// Fetch phone number based on username
$old_date = null;
$sql_date = "SELECT Date FROM seat_db WHERE Username = ?";
$stmt_date = $conn->prepare($sql_date);
$stmt_date->bind_param('s', $username);
$stmt_date->execute();
$result_date = $stmt_date->get_result();

if ($result_date->num_rows > 0) {
    $row = $result_date->fetch_assoc();
    $old_date = $row['Date'];
}

$stmt_date->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['edit_Username']) && !empty($_POST['edit_Phone_Number']) && !empty($_POST['edit_No_of_Sitter']) && !empty($_POST['edit_Person']) && !empty($_POST['edit_Date'])) {
      
        $edited_Username = $_POST['edit_Username'];
        $edited_Phone_Number = $_POST['edit_Phone_Number'];
        $edited_No_of_Sitter = $_POST['edit_No_of_Sitter'];
        $edited_Person = $_POST['edit_Person'];
        $edited_Date = $_POST['edit_Date'];

        if ($edited_Date >= $old_date) {
            if ($edited_No_of_Sitter >= $edited_Person) {
                $sql_update = "UPDATE seat_db 
                               SET Phone_Number = ?, No_of_Sitter = ?, Person = ?, Date = ?
                               WHERE Username = ?";

                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param('sisss', $edited_Phone_Number, $edited_No_of_Sitter, $edited_Person, $edited_Date, $edited_Username);

                if ($stmt_update->execute()) {
                    echo '<script>alert("Data Updated Successfully");</script>';
                    echo '<script>window.location.href = "UserOrAdmin.php";</script>';
                } else {
                    echo '<script>alert("Error updating data.");</script>';
                }

                $stmt_update->close();
            } else {
                echo "<script> alert('Person cannot be more than the seats.'); </script>";
            }
        } else {
            echo "<script> alert('Choose a valid date.'); </script>";
        }
    } else {
        echo "<script> alert('All fields are required.'); </script>";
    }
}
echo "The post is not available.";
?>
