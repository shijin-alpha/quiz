<?php

$username = $_POST['userid'];
$password = $_POST['password'];
$conn = mysqli_connect("localhost", "root", "", "quiz_database") or die("connection failed");

// Check if the user already exists in user_scores table
$sqlCheckUser = "SELECT * FROM `user_scores` WHERE user_id='$username'";
$resultCheckUser = mysqli_query($conn, $sqlCheckUser);

if (mysqli_num_rows($resultCheckUser) == 0) {
    // User does not exist in user_scores table, so insert the user information
    $sqlGetUsername = "SELECT `Name` FROM `user` WHERE userid='$username' and role='user'";
    $resultGetUsername = mysqli_query($conn, $sqlGetUsername);

    if ($resultGetUsername && mysqli_num_rows($resultGetUsername) > 0) {
        $rowUsername = mysqli_fetch_row($resultGetUsername);
        $insertSql = "INSERT INTO `user_scores` (`user_id`, `username`) VALUES ('$username', '$rowUsername[0]')";
        $resultInsert = mysqli_query($conn, $insertSql);

        if (!$resultInsert) {
            die("Query failed: " . mysqli_error($conn));
        }
    }
}

// Continue with the login authentication
$sql = "SELECT `role` FROM `user` WHERE userid='$username' AND password='$password'";
$result = mysqli_query($conn, $sql) or die("query failed");

if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
    $user_role = $row['role'];

    if ($user_role === 'admin') {
        header("Location: admin.html");
    } else {
        header("Location: home.html");
    }
} else {
    // If no matching user found, redirect to an error page or display an error message
    header("Location: invalid.html"); 
}
?>
