<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php'); 
    exit();
}

include 'config.php';


$userId = $_SESSION['user']['id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
$user = mysqli_fetch_assoc($result);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    
    $updateQuery = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id=$userId";
    
    if (mysqli_query($conn, $updateQuery)) {
        header('Location: profile.php'); 
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<div class="navbar">
    <div class="dropdown">
        <a href="#" class="dropbtn">
            <img src="<?php echo $user['profile_picture'] ? $user['profile_picture'] : 'default.png'; ?>" alt="Profile Picture" class="profile-pic"> 
            <?php echo $_SESSION['user']['firstname']; ?>
        </a>
        <div class="dropdown-content">
            <a href="profile.php">Profile</a> 
            <a href="<?php echo $_SESSION['user']['role'] == 'admin' ? 'admin.php' : 'user.php'; ?>">
                Return to Dashboard
            </a> 
            <a href="logout.php">Logout</a> 
        </div>
    </div>
</div>

<h1>Profile Information</h1>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required><br>
    
    <label>Last Name:</label>
    <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required><br>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

    <button type="submit">Update Profile</button>
</form>

</body>
</html>
