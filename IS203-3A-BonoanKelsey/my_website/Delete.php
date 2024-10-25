<?php
include 'config.php';
$id = $_GET['id'];
$query = "DELETE FROM records WHERE id = $id";
mysqli_query($conn, $query);
header('Location: admin.php');
?>