<?php
session_start();
require_once "connection.php";

// Initialize variables
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updated'])) {
    // Validate and retrieve form inputs
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $dob = isset($_POST['date']) ? trim($_POST['date']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone_number = isset($_POST['number']) ? trim($_POST['number']) : '';
    $gender = isset($_POST['Gender']) ? trim($_POST['Gender']) : '';
    $hobi = isset($_POST['hobi']) ? implode(', ', $_POST['hobi']) : '';
    $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';
    $about = isset($_POST['about']) ? trim($_POST['about']) : '';

    // Validate ID
    if ($id <= 0) {
        $message = "Invalid ID provided.";
    } else {
        // Handle file upload (if a new photo is uploaded)
        if (!empty($photo)) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        } else {
            // Use the existing photo if no new photo is uploaded
            $photo = isset($_POST['existing_photo']) ? $_POST['existing_photo'] : '';
        }

        // Update the record
        $updateQuery = "UPDATE record 
                        SET name = ?, dob = ?, email = ?, phone_number = ?, gender = ?, hobi = ?, photo = ?, about = ?
                        WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssssssi", $name, $dob, $email, $phone_number, $gender, $hobi, $photo, $about, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Record updated successfully!');</script>";
        } else {
            $message = "Error updating record: " . $conn->error;
        }
    }
    
}

// Fetch existing data for the record
if ($id > 0) {
    $editQuery = "SELECT * FROM record WHERE id = ?";
    $stmt = $conn->prepare($editQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
    } else {
        $message = "No record found with ID: $id";
    }
} else {
    $message = "Invalid or missing ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<style>
    .error {
            color: red;
        }

        label {
            font-size: 20px;
            color: yellow;
            font-weight: bold;
        }

        .p {
            font-size: 20px;
            color: white;
            font-weight: bold;
        }
</style>
</head>
<body>
<div class="container-fluid d-flex justify-content-center bg-dark">
    <h2 class="text-center">Update Record</h2>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="border border-2 border-danger m-5 p-3 w-3 w-50 shadow-sm p-3 mb-5 bg-secondary rounded">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($record['name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" name="date" value="<?= htmlspecialchars($record['dob'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($record['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" name="number" value="<?= htmlspecialchars($record['phone_number'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender:</label><br>
            <input type="radio" name="Gender" value="male" <?= (isset($record['gender']) && $record['gender'] === 'male') ? 'checked' : '' ?>> Male
            <input type="radio" name="Gender" value="female" <?= (isset($record['gender']) && $record['gender'] === 'female') ? 'checked' : '' ?>> Female
        </div>

        <div class="mb-3">
            <label class="form-label">Hobbies:</label><br>
            <?php $hobbies = explode(', ', $record['hobi'] ?? ''); ?>
            <label><input type="checkbox" name="hobi[]" value="Reading" <?= in_array('Reading', $hobbies) ? 'checked' : '' ?>> Reading</label>
            <label><input type="checkbox" name="hobi[]" value="Traveling" <?= in_array('Traveling', $hobbies) ? 'checked' : '' ?>> Traveling</label>
            <label><input type="checkbox" name="hobi[]" value="Gaming" <?= in_array('Gaming', $hobbies) ? 'checked' : '' ?>> Gaming</label>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo:</label>
            <input type="file" class="form-control" name="photo">
            <input type="hidden" name="existing_photo" value="<?= htmlspecialchars($record['photo'] ?? '') ?>">
            <p>Current Photo: <?= htmlspecialchars($record['photo'] ?? 'No photo uploaded') ?></p>
        </div>

        <div class="mb-3">
            <label for="about" class="form-label">About:</label>
            <textarea class="form-control" name="about"><?= htmlspecialchars($record['about'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="updated">Update</button>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </form>
</div>
</body>
</html>
