<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Question</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .success-message {
            color: #4CAF50;
            font-weight: bold;
            margin-top: 20px;
        }

        .error-message {
            color: #D32F2F;
            font-weight: bold;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #1E88E5;
            font-weight: bold;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $question_id = $_POST["question_id"];
        
        $sql = "DELETE FROM questions WHERE question_id = $question_id";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Question deleted successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>


    <?php if (!empty($message)) : ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <br>
    <br>
    <a href="delete_quiz.html">Delete quiz page</a><br>
    <br>
    <a href="admin.html">Admin page</a>
</body>
</html>
