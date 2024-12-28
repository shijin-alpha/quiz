<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
$conn=mysqli_connect($servername,$username,$password,$dbname) or die ("connection failed");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = $_POST["question_id"];
    $question = $_POST["question_text"];
    $optiona = $_POST["option1"];
    $optionb = $_POST["option2"];
    $optionc = $_POST["option3"];
    $optiond = $_POST["option4"];
    $correct_answer = $_POST["correct_option"];

    // Insert quiz data into the database
    $sql = "INSERT INTO questions  VALUES ('$question_id', '$question', '$optiona', '$optionb', '$optionc', '$optiond', '$correct_answer')";

    if ($conn->query($sql) === TRUE) {
        $success_message="Question added successfully!";
    } else {
        $error_message= "Error: "  . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>ADD Question</title>
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
    <br><br><br>
   <h2><a href="add_quiz.html" > Quiz add page</a></h2>
   <a href="admin.html">Admin page</a><br><br>
</body>
</html>