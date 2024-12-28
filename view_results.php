<html>
    <head>
        <title>
            SCORE</title>
            <link rel="stylesheet" type="text/css" href="result.css">
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
$sql = "SELECT username, user_id, score FROM user_scores WHERE score != 0";

$result = $conn->query($sql);
?>

    <h2>Score Page</h2>
    <?php
    if ($result->num_rows > 0) {
        // Output table header
        echo "<table>";
        echo "<tr><th>Username</th><th>User ID</th><th>Score</th></tr>";

        // Output data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['user_id']}</td>";
            echo "<td>{$row['score']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No scores found in the database where the score is not zero.";
    }

    // Close the database connection
    $conn->close();
    ?>
  Main page  <a href="admin.html" class="button"> here</a>
</body>
</html>
