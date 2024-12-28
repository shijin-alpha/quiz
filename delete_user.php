<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for updating user details
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST["user_id"];
            // Update the user data in the database based on the user_id
            $sql_score = "DELETE FROM user_scores WHERE user_id = '$user_id'";
            $conn->query($sql_score);
            $sql_delete = "DELETE FROM user WHERE userid = '$user_id'";


    if ($conn->query($sql_delete) === TRUE) {
        $success_message="User deleted successfully!";
    } else {
        $error_message= "Error " . $conn->error;
    }
    if (!isset($success_message) && empty($error_message)) {
        $error_message = "User not found in the database.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <link rel="stylesheet" type="text/css" href="delete_user.css">
</head>
<body>
    </form>

    <?php
    if (isset($success_message)) {
        echo '<div class="success-message">' . $success_message . '</div>';
    }

    if (isset($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
    ?>
    <a href="delete_user.html">CLICK</a><br><br>
    <a href="admin.html" class="button">Admin page</a>
</body>
</html>