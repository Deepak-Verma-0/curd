<?php
include 'connection.php';

// Get the record ID
$id = $_GET['id'];

// Validate the ID
if (!is_numeric($id)) {
    echo "Invalid ID.";
    exit;
}

// Delete the record from the database
$query = "DELETE FROM record WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "Record deleted successfully.";
    header("Location: preview.php"); // Redirect to the main page
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>