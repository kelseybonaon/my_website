<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit();
}
include 'config.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    
    $query = "INSERT INTO records (title, description) VALUES ('$title', '$description')";
    
    
    if (mysqli_query($conn, $query)) {
        
        header('Location: admin.php'); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); //error message display
    }
}

// admin records
$records = mysqli_query($conn, "SELECT * FROM records");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- stylesheet link-->
</head>
<body>

<!-- drop down for logout and the profile -->
<div class="navbar">
    <div class="dropdown">
        <a href="#" class="dropbtn">
            <?php echo $_SESSION['user']['firstname']; ?> <!-- user name display -->
        </a>
        <div class="dropdown-content">
            <a href="profile.php">Profile</a> <!--profile page -->
            <a href="logout.php">Logout</a> <!-- Logout -->
        </div>
    </div>
</div>

<!-- Main content of the page -->
<h2>Admin Dashboard</h2>

<!--add new records here-->
<form method="POST">
    <label>Title:</label>
    <input type="text" name="title" required><br>
    <label>Description:</label>
    <textarea name="description" required></textarea><br>
    <button type="submit">Add Record</button>
</form>

<h3>All Records</h3>

<!--Button to print-->
<button onclick="window.print()">Print this page</button>

<!--Table to display the records-->
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($records)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['description'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
