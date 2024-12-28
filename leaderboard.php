<!DOCTYPE html>
<html>
<head>
    <title>SCORE</title>
    <link rel="stylesheet" type="text/css" href="result.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        ol {
            list-style: none;
            padding: 0;
            margin: 20px;
        }

        li {
            background-color: #fff;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        li:hover {
            transform: scale(1.05);
        }

        .button {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #45a049;
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

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select username, user_id, and score where score is not equal to zero
    $sql = "SELECT username, score FROM user_scores WHERE score != 0 ORDER BY score DESC";
    $result = $conn->query($sql);
    ?>

    <h2>Score Page</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<ol>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['username']} - Score: {$row['score']}</li>";
        }
        echo "</ol>";
    } else {
        echo "No scores found in the database where the score is not zero.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <a href="home.html" class="button">Main page</a>
</body>
</html>
