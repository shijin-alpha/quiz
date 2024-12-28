<html>
<head>
    <title>Score Page</title>
</head>
<body>
<style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_database";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_SESSION['user_score'], $_SESSION['user_id'])) {
    $score = $_SESSION['user_score'];
    $u = $_SESSION['user_id'];

    $totalQuestions = $_SESSION['totalquestion'];
    $per = ($score / $totalQuestions) * 100;

    $sql = "SELECT Name FROM user WHERE userid = '$u'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['Name'];

        // Check if the user already exists in the user_scores table
        $checkSql = "SELECT * FROM user_scores WHERE user_id = '$u'";
        $checkResult = $conn->query($checkSql);

        if ($checkResult && $checkResult->num_rows > 0) {
            // Update the user's score in the user_scores table
            $updateSql = "UPDATE user_scores SET score = '$score' WHERE user_id = '$u'";
            if ($conn->query($updateSql) === TRUE) {
            } else {
                echo "Error updating score: " . $conn->error;
            }
        
        }
    }
} else {
    echo "Score or user ID not available.";
}

$grade = '';

if ($score >= 20) {
    $grade = 'A+';
} elseif ($score >= 16) {
    $grade = 'A';
} elseif ($score >= 12) {
    $grade = 'B+';
} elseif ($score >= 8) {
    $grade = 'B';
} elseif ($score >= 4) {
    $grade = 'C+';
} else {
    $grade = 'C';
}

$conn->close();
?>



    <form action="home.html" method="get">
    
</form>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Competition Certificate</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.certificate {
    width: 600px;
    margin: 50px auto;
    border: 5px solid #4CAF50;
    padding: 20px;
    text-align: center;
    background-color: #fff;
    position: relative; /* To position the seal and signature */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.certificate h2 {
    color: #4CAF50;
    font-size: 28px;
}

.participant-name {
    font-size: 32px;
    font-weight: bold;
    margin: 30px 0;
}

.event-details {
    font-size: 22px;
    margin-bottom: 20px;
}

.score-grade {
    font-size: 24px;
    margin-top: 40px;
}

.print-btn {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
}

/* Positioning seal and signature */
.seal {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 100px; /* Adjust size as needed */
}

.signature {
    position: absolute;
    bottom: 20px;
    left: 20px;
    width: 150px; /* Adjust size as needed */
}

    </style>
</head>
<body>

    <div class="certificate">
        <h2>Quiz Competition Certificate</h2>

        <!-- Participant's Name -->
        <div class="participant-name">
            This is to certify that<br>
            <?php echo  $username;  ?>
        </div>

        <!-- Event Details -->
        <div class="event-details">
            Has successfully participated in the<br>
            Quiz Competition
        </div>

        <!-- Score Details -->
        <div class="score-grade">
            Score: <?php echo $score; ?> <br>
            Percentage: <?php echo $per; ?>%<br>
            Grade: <?php echo $grade; ?>
        </div>

        <!-- Print Button -->
        <button class="print-btn" onclick="printCertificate()">Print</button>

        <!-- Seal Image -->
        <img src="/PROJECT/img/q3.png" alt="Seal" class="seal">

        <!-- Signature Image -->
        <img src="" alt="Signature" class="signature">
    </div>

    <script>
        function printCertificate() {
            window.print();
        }
    </script>
</body>
</html>
