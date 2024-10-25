<?php
include 'config.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "UPDATE records SET title = '$title', description = '$description' WHERE id = $id";
    mysqli_query($conn, $query);
    header('Location: admin.php');
}

// code to fetch the records for edit
$record = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM records WHERE id = $id"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Record</h2>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?= $record['title'] ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?= $record['description'] ?></textarea><br>
        <button type="submit">Update Record</button>
    </form>
</body>
</html>