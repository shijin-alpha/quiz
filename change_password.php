<html>
<head>
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            display: block;
            margin-bottom: 10px;
            width: calc(100% - 20px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_database";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_id = $_POST["user_id"]; 
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

   
    if ($new_password !== $confirm_password) {
        echo "New password and confirm password do not match.";
    } else {
        
        $sql_update_password = "UPDATE user SET password = '$new_password' WHERE userid = '$user_id'";

        if ($conn->query($sql_update_password) === TRUE) {
            echo "Password updated successfully for user with ID: " . $user_id;
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
}

$conn->close();
?>
<br>
<br>
 <a href="change_password.html" class="button">Go to the change passaword</a><br><br>
        <a href="home.html" class="button">Home page</a>
</html>