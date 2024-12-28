<html>
<head>
    <title>Update User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 300px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }
        input[type="text"],
        input[type="number"],
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
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
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
        
            
            // Retrieve updated data from the form
            $new_username = $_POST["new_address"];
            $new_phone = $_POST["new_phone"];
            
            // Update the user data in the database based on the user_id
            $sql_update = "UPDATE user SET Address = '$new_username', phoneno = '$new_phone' WHERE userid = '$user_id'";

    if ($conn->query($sql_update) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<a href="admin_manage.html">Edit page</a><br><br>
<a href="home.html">Home page</a>
</html>