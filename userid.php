<?php
$name=$_POST['user_id'];
$username=$_POST['name'];
$conn = mysqli_connect('localhost', 'root', '', 'quiz_database') or die ("connection failed");
$sql = "INSERT INTO user_scores VALUES ('$name','$username')";
$result=mysqli_query($conn,$sql) or die ("query failed");
echo "Successfull";
header("Location: quiz.php");
?>