<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'user') {
    header('Location: index.php');
    exit();
}
include 'config.php';


$records = mysqli_query($conn, "SELECT * FROM records");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>


<div class="navbar">
    <div class="profile-pic">
        <a href="profile.php"> 
            <img src="path/to/profile/picture.jpg" alt="Profile Picture" width="50" height="50"> 
        </a>
    </div>
    <div class="dropdown">
        <a href="#" class="dropbtn">
            <?php echo $_SESSION['user']['firstname']; ?> 
        </a>
        <div class="dropdown-content">
            <a href="profile.php">Profile</a> 
            <a href="logout.php">Logout</a> 
        </div>
    </div>
</div>

<h3>All Records</h3>

<button onclick="window.print()">Print this page</button>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($records)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['title'] ?></td>
        <td><?= $row['description'] ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
