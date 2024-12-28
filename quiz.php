<!DOCTYPE html>
<html>
<head>
    <title>Quiz Page</title>
    <link rel="stylesheet" type="text/css" href="./quizz.css">
    <script src="timer.js"></script>
    <style>
        /* Add your CSS styles for card-like structure here */
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: none; /* Initially hide all cards */
        }
        .show {
            display: block; /* Show the current card */
        }
    </style>
</head>
<body style="background-color:#1bafe0">
    <div class="container">
        <h1>Quiz Competition</h1>
        <div id="timer">Time Left: <span id="countdown">23:00</span></div>
        <?php
        // Connect to the database (you need to set your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "quiz_database";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['final_submit'])) {
            $score = 0;  // Initialize the score
            $totalQuestions = 0;  // Initialize the total number of questions
        
            // Process the submitted answers and calculate the score
            $sql = "SELECT question_id, correct_option FROM questions";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $questionId = $row['question_id'];
                    $correctOption = $row['correct_option'];
                    
                    // Check if a selected answer matches the correct answer for each question
                    if (isset($_POST['q' . $questionId]) && $_POST['q' . $questionId] == $correctOption) {
                        $score++;
                    }
                    
                    $totalQuestions++;
                }
            }
        
            // Store the score in a session variable to pass it to the score page
            session_start();
            $_SESSION['user_score'] = $score;
            $_SESSION['user_id']=$_POST['t1'];
            $_SESSION['totalquestion']=$totalQuestions;
            // Redirect to the score page
            header("Location: score.php");
            exit;
        }
        ?>
        <div class="quiz-card">
        <?php
// Assume these values are fetched from your database or calculated in your PHP logic
$sql = "SELECT username,user_id,score from user_scores";

$result = $conn->query($sql);
?>
            <?php
            // Select questions and options from the database
            $sql = "SELECT question_id, question_text, option1, option2, option3, option4 FROM questions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                echo "<br>Enter uid: <input type='text' name='t1'><br>";
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count++;
                    $questionId = $row['question_id'];
                    
                    // Display a card for each question
                    echo '<div class="card ' . ($count === 1 ? 'show' : '') . '" id="question_' . $count . '">';
                    echo "<p>Question " . $count . ": " . $row['question_text'] . "</p>";

                    // Display all four options
                    for ($i = 1; $i <= 4; $i++) {
                        $optionColumnName = 'option' . $i;
                        echo '<input type="radio" name="q' . $questionId . '" value="' . $i . '"';
                    
                        // Indicate if the option was selected
                        if (isset($_POST['q' . $questionId]) && $_POST['q' . $questionId] == $i) {
                            echo ' checked="checked"';
                        }
                        
                        echo '>';
                        echo $row[$optionColumnName] . '<br>';
                    }
                    echo '</div>';
                }

                // Add a "Next" button to move to the next question
                echo '<input type="button" value="Next" onclick="showNextQuestion(' . $count . ')">';
                echo '<input type="submit" name="final_submit" value="Calculate Score" style="display:none">';
                echo '</form>';
            } else {
                echo "No questions found in the database.";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <script>
        
        function showNextQuestion(questionCount) {
            var currentQuestion = document.querySelector('.card.show');
            var nextQuestionNumber = parseInt(currentQuestion.id.split('_')[1]) + 1;

            if (nextQuestionNumber <= questionCount) {
                currentQuestion.classList.remove('show');
                document.getElementById('question_' + nextQuestionNumber).classList.add('show');
            } else {
                // Show the "Calculate Score" button if all questions have been displayed
                document.querySelector('input[name="final_submit"]').style.display = 'block';
            }
        }
    </script>
</body>
</html>
