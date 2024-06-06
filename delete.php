<?php

include 'connection.php';

// Get the id from the URL parameter
$id = $_GET['id'];

// Prepare and execute the SQL query to delete the data
$sql = "DELETE FROM new_equip WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "Item was successfully deleted";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>