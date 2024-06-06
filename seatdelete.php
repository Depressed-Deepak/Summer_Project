<?php
// Include the database connection file
include('connection.php');

// Check if the ID is set
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    // sql to delete a record
    $sql = "DELETE FROM seat_db WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    $conn->close();
} else {
    echo "Invalid ID";
}
?>