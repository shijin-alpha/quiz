<!DOCTYPE html>
<html>
<head>
    <title>View Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            margin-bottom: 10px;
        }
        ol {
            list-style: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 10px;
            list-style-type: disc;
        }
        .question {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .options {
            margin-top: 8px;
            margin-left: 25px;
        }
        .correct-answer {
            margin-top: 8px;
            margin-left: 25px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<a href="admin.html">Go back</a><br><br>
    <h2>Questions</h2>
    <ol type="disc">
        <?php
        // Database connection setup and PHP code for fetching and displaying questions
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "quiz_database";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li class="question">';
                echo '<h3>Question :' . $row["question_id"] . '</h3>';
                echo '<p>' . $row["question_text"] . '</p>';
                echo '<ul class="options">';
                echo '<li>' . $row["option1"] . '</li>';
                echo '<li>' . $row["option2"] . '</li>';
                echo '<li>' . $row["option3"] . '</li>';
                echo '<li>' . $row["option4"] . '</li>';
                echo '</ul>';
                echo '<p class="correct-answer">Correct Answer: ' . $row["correct_option"] . '</p>';
                echo '</li>';
            }
        } else {
            echo "<li>No questions found.</li>";
        }

        $conn->close();
        ?>
    </ol>
</body>
</html>
